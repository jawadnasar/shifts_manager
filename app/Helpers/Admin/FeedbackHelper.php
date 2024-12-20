<?php

namespace App\Helpers\Admin;

use App\Models\Certificate;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FeedbackHelper {

    public static function index(){
        $feedbacks  = Contact::all();
        return view('admin.feedbacks', compact('feedbacks'));
    }

   
}


