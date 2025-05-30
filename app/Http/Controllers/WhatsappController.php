<?php

namespace App\Http\Controllers;

use App\Models\SenderId;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\Template\Template;

class WhatsappController extends Controller
{
    public function index(){
        return view('page.dashboard');
    }

    public function userList(){
        $userList = User::get();
        return view('page.user-list', compact('userList'));
    }

    public function createSession(){
        return view('page.create-whatsapp-session');
    }
    
    
}
