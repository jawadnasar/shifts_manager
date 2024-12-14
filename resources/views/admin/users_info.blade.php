

<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>User</th>
            <th>Licence</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users_data as $key => $row)
        @php
            $det = $row->relate_user_details;
        @endphp
            <tr>
                <td>{{$users_data->firstItem() + $loop->index}}</td>
                <td>{{$row->full_name}}</td>
                <td>{{$row->email}}</td>
                <td>{{$det->city}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-md-12">
        @if ($users_data)
            {{ $users_data->appends(request()->query())->links('pagination::bootstrap-5') }}
        @endif
    </div>
</div>
