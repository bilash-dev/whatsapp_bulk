<?php

namespace App\Http\Controllers;

use App\Models\CsvUpload;
use App\Models\MessageTemplate;
use App\Models\SenderId;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    
   
    public function campaign(){

        $senderID = SenderId::get();
        $templates = MessageTemplate::get();
        $csvFiles = CsvUpload::get();
        return view('page.campaign', compact('senderID', 'templates', 'csvFiles'));
    }

    
    public function campaingSend(){
        //
    }
}
