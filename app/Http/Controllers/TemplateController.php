<?php

namespace App\Http\Controllers;

use App\Models\MessageTemplate;
use App\Models\SenderId;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    
    public function createTemplate(){
        return view('page.template');
    }
    
    public function templateStore(Request $request){
        
        try{
            $validated = $request->validate([
                'name' => 'required|string',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
                
            ]);
    
            if($request->hasFile('image')){
                $filename = 'template_' . now()->format('Ymd_His') . '.' . $request->file('image')->getClientOriginalExtension();
                $validated['image'] = $request->file('image')->storeAs('templates', $filename, 'public');
            }
    
            // Add current logged-in user as user_id
            $validated['user_id'] = Auth::id();
            // $validated['senderID'] = SenderId::where('sender_ids',$id);
    
            MessageTemplate::create($validated);
    
            return redirect()->route('campaign.view')->with('success', 'Message template created successfully.');
        
        }catch(\Exception $e){
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
