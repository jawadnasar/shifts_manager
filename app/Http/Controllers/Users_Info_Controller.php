<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Users_Info_Controller extends Controller
{

    /**
     * This class will handle all the infomation regarding users 
     */


     // Show the users page where we can search for users and their info
    public function index()
    {
        $users_data = $this->get_users();
        return View('admin.users_info')->with(compact('users_data'));
    }

    private function get_users(){
        $data = User::paginate(10);
        return $data;
    }
}
