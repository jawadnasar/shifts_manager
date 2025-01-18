@extends('admin.layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- Recent Sales Start -->
        <div class="container-fluid">
            <div class="text-center rounded p-4">
                <div class="row">
                    From: <input type="text" name="from_email" id="from_email" value="{{ env('MAIL_FROM_ADDRESS') }}">
                </div>
                <div class="row">
                    To: <input type="text" name="to_email" id="to_email">(For many emails just separate them with a
                    simicolon)
                </div>

                <div class="row">
                    subject: <input type="text" name="subject" id="subject" value="{{ $template->subject_line }}">
                </div>
                <div class="row">
                    <textarea name="email_body" id="email_body" cols="30" rows="10">{{ $template->body }}{{ Auth::user()->name }} 
                    </textarea>
                </div>
                <div>
                    {{ $template->footer }}
                </div>
            </div>
        </div>
    @endsection
