<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\ClockEntry;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;
use App\Models\Account;

class ShiftsController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'client_id' => ['nullable', 'integer', 'exists:accounts,accountid'],
            'status' => ['nullable', 'in:open,closed'],
        ]);

        $shifts = Shift::query()
            ->with('user', 'client', 'clockEntries')
            ->when(! empty($validated['date_from']), function ($query) use ($validated) {
                $query->whereDate('shift_date', '>=', $validated['date_from']);
            })
            ->when(! empty($validated['date_to']), function ($query) use ($validated) {
                $query->whereDate('shift_date', '<=', $validated['date_to']);
            })
            ->when(! empty($validated['user_id']), function ($query) use ($validated) {
                $query->where('user_id', $validated['user_id']);
            })
            ->when(! empty($validated['client_id']), function ($query) use ($validated) {
                $query->where('client_id', $validated['client_id']);
            })
            ->when(! empty($validated['status']), function ($query) use ($validated) {
                if ($validated['status'] === 'open') {
                    $query->whereHas('clockEntries', function ($entryQuery) {
                        $entryQuery->whereNull('clock_out_datetime');
                    });
                }

                if ($validated['status'] === 'closed') {
                    $query->whereDoesntHave('clockEntries', function ($entryQuery) {
                        $entryQuery->whereNull('clock_out_datetime');
                    });
                }
            })
            ->orderByDesc('shift_date')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        $users = User::query()
            ->orderBy('name')
            ->get();

        $accounts = Account::query()
            ->where('is_active', true)
            ->whereIn('accountid', Shift::query()->whereNotNull('client_id')->select('client_id')->distinct())
            ->orderBy('company')
            ->orderBy('name')
            ->get();

        return view('admin.shifts.index', compact('shifts', 'users', 'accounts'));
    }

    public function clockIn(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'client_id' => 'nullable|exists:accounts,accountid',
            'clock_in_datetime' => 'required|date',
            'clock_out_datetime' => 'nullable|date',
            'user_rate' => 'required|numeric',
            'client_rate' => 'required|numeric',
        ]);

        $clockIn = Carbon::parse($request->clock_in_datetime);
        $clockOut = null;
        if ($request->filled('clock_out_datetime')) {
            $clockOut = Carbon::parse($request->clock_out_datetime);
        }

        $shift = Shift::create([
            'user_id' => $request->user_id,
            'client_id' => $request->client_id, // <-- save selected account
            'user_rate' => $request->user_rate,
            'client_rate' => $request->client_rate,
            'shift_date' => $clockIn->toDateString(),
        ]);

        $entryData = [
            'shift_id' => $shift->id,
            'clock_in_datetime' => $clockIn,
        ];

        if ($clockOut) {
            $entryData['clock_out_datetime'] = $clockOut;
        }

        ClockEntry::create($entryData);

        if ($clockOut) {
            $this->calculateTotals($shift);
        }

        return redirect()->back()->with('success', 'Clocked in successfully.');
    }

    public function clockOut(Request $request, $shiftId)
    {
        $shift = Shift::findOrFail($shiftId);
        $lastEntry = $shift->clockEntries()->whereNull('clock_out_datetime')->latest()->first();

        if ($lastEntry) {
            $lastEntry->update(['clock_out_datetime' => now()]);
            $this->calculateTotals($shift);
        }

        return redirect()->back()->with('success', 'Clocked out successfully.');
    }

    public function edit($id)
    {
        $shift = Shift::with('user', 'clockEntries')->findOrFail($id);
        $firstEntry = $shift->clockEntries()->orderBy('clock_in_time')->first();
        $users = User::all();

        return view('admin.shifts.edit', compact('shift', 'users', 'firstEntry'));
    }

    public function update(Request $request, $id)
    {
        $shift = Shift::with('clockEntries')->findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'shift_date' => ['required', 'date'],
            'user_rate' => 'required|numeric',
            'client_rate' => 'required|numeric',
            'clock_in_datetime' => 'nullable|date',
            'clock_out_datetime' => 'nullable|date',
        ]);

        $shift->update([
            'user_id' => $request->user_id,
            'user_rate' => $request->user_rate,
            'client_rate' => $request->client_rate,
            'shift_date' => $request->shift_date,
        ]);

        $firstEntry = $shift->clockEntries()->orderBy('clock_in_datetime')->first();
        if (! $firstEntry) {
            $firstEntry = $shift->clockEntries()->create([
                'clock_in_datetime' => now(),
            ]);
        }

        if ($request->filled('clock_in_datetime')) {
            $firstEntry->clock_in_datetime = Carbon::parse($request->clock_in_datetime);
        }

        if ($request->filled('clock_out_datetime')) {
            $firstEntry->clock_out_datetime = Carbon::parse($request->clock_out_datetime);
        }

        $firstEntry->save();

        $this->calculateTotals($shift);

        return redirect()->route('admin.shifts.show', $shift->id)->with('success', 'Shift updated successfully.');
    }

    private function calculateTotals(Shift $shift)
    {
        $totalHours = 0;
        foreach ($shift->clockEntries as $entry) {
            if ($entry->clock_out_datetime) {
                $totalHours += $entry->clock_in_datetime->diffInHours($entry->clock_out_datetime);
            }
        }
        $shift->update([
            'total_hours' => $totalHours,
            'total_pay_user' => $totalHours * $shift->user_rate,
            'total_billed_client' => $totalHours * $shift->client_rate,
        ]);
    }

    public function show($id)
    {
        $shift = Shift::with('user', 'clockEntries')->findOrFail($id);
        return view('admin.shifts.show', compact('shift'));
    }
}