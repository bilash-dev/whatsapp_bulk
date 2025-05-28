<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\Template\Template;

class WhatsappController extends Controller
{
    public function index(){
        return view('page.dashboard');
    }

    public function createTemplate(){
        return view('page.template');
    }

   
    public function campaign(){
        return view('page.campaign');
    }
    
    public function userList(){
        $userList = User::get();
        return view('page.user-list', compact('userList'));
    }

    public function createSession(){
        return view('page.create-whatsapp-session');
    }
    
    // public function create(User $user, CsvFile $csvFile, Template $template)
    // {    return view('campaign.create', [
    //         'templates' => Template::all(),
    //         'csvFiles' => CsvFile::all(),
    //         'users' => User::all()
    //     ]);
    // }
}
