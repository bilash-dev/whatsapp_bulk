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
            'phone_number' => 'required|unique:sender_ids,phone_number',
        ]);

        SenderId::create([
            'phone_number' => $request->phone_number,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('upload.csv')->with('success', 'Sender ID added successfully!');
    }
}
