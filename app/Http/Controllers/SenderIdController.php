<?php

namespace App\Http\Controllers;

use App\Models\SenderId;
use Illuminate\Http\Request;

class SenderIdController extends Controller
{
    public function index(){
        //
    }

    public function createSession(){
        return view('page.create-whatsapp-session');
    }

    public function store(Request $request){
        
        $validated = $request->validate([
            'senderId' => 'required|unique:sender_ids,senderId',
        ]);

        SenderId::create([
            'senderId' => $request->senderId,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('upload.csv')->with('success', 'Sender ID added successfully!');
    }
}
