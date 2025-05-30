<?php

namespace App\Http\Controllers;

use App\Models\SenderId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SenderIdController extends Controller
{
    public function index(){
        //
    }

    public function createSession(){
        return view('page.create-whatsapp-session');
    }

    //sender ID store
    // public function store(Request $request){
        
    //     $validated = $request->validate([
    //         'senderId' => 'required|unique:sender_ids,senderId',
    //     ]);

    //     SenderId::create([
    //         'senderId' => $request->senderId,
    //         'user_id' => auth()->id(),
    //     ]);

    //     return redirect()->route('upload.csv')->with('success', 'Sender ID added successfully!');
    // }



        // public function store(Request $request)
        // {
        //     $validated = $request->validate([
        //         'senderId' => 'required|unique:sender_ids,senderId',
        //     ]);

        //     // Create the sender ID first
        //     SenderId::create([
        //         'senderId' => $request->senderId,
        //         'user_id' => auth()->id(),
        //     ]);

        //     // Check if the phone number has WhatsApp account
        //     if ($this->hasWhatsAppAccount($request->senderId)) {
        //         // Open WhatsApp in server's browser
        //         $user = auth()->user();
        //         $browser = $user->browser_preference === 'firefox' ? 'firefox' : 'google-chrome';
                
        //         $command = sprintf(
        //             '%s %s https://web.whatsapp.com/send?phone=%s > /dev/null 2>&1 &',
        //             $browser,
        //             $user->browser_preference === 'firefox' ? '-new-tab' : '--new-tab',
        //             $request->senderId
        //         );
                
        //         shell_exec($command);
                
        //         return redirect()->route('upload.csv')->with('success', 'WhatsApp opened for the provided number!');
        //     }

        //     // If no WhatsApp account, redirect to another route
        //     return redirect()->back()->with('error', 'This number is not registered with WhatsApp.');
        // }

        // private function hasWhatsAppAccount($phoneNumber)
        // {
        //     // Clean the phone number (remove any non-digit characters)
        //     $cleanNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
            
        //     // Construct the WhatsApp API URL
        //     $url = "https://web.whatsapp.com/send?phone={$cleanNumber}";
            
        //     // Initialize cURL
        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, $url);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        //     curl_setopt($ch, CURLOPT_NOBODY, true); // HEAD request only
        //     curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout in seconds
            
        //     // Execute the request
        //     curl_exec($ch);
        //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //     curl_close($ch);
            
        //     // WhatsApp returns 200 for valid numbers, even if not registered,
        //     // but the page content differs. This is a basic check.
        //     // You might need a more sophisticated check like checking page title or content.
            
        //     // For now, we'll assume all numbers are valid (since WhatsApp web doesn't easily expose this)
        //     return true;
            
        //     // Note: This is a simplistic approach. WhatsApp doesn't provide a public API for this check.
        //     // You might need to use a commercial WhatsApp API service for accurate verification.
        // }
    
        // private function openHeadlessWhatsApp($phoneNumber)
        // {
        //     $cleanNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        //     $url = escapeshellarg("https://web.whatsapp.com/send?phone={$cleanNumber}");
            
        //     $command = "xvfb-run --auto-servernum --server-args='-screen 0, 1024x768x24' ".
        //             "google-chrome --no-sandbox --disable-gpu {$url} > /dev/null 2>&1 &";
            
        //     shell_exec($command);
        // }


        public function store(Request $request)
        {
            $validated = $request->validate([
                'senderId' => 'required|unique:sender_ids,senderId',
            ]);

            try {
                $senderId = SenderId::create([
                    'senderId' => $request->senderId,
                    'user_id' => auth()->id(),
                ]);

                $opened = $this->openWhatsAppInServerBrowser($request->senderId);
                
                return redirect()
                    ->route('upload.csv')
                    ->with('success', $opened 
                        ? 'WhatsApp opened successfully!' 
                        : 'Saved, but could not open WhatsApp');

            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->with('error', 'Error: '.$e->getMessage());
            }
        }

        private function openWhatsAppInServerBrowser($senderId)
        {
            // URL to open, optionally with a pre-filled message or contact (WhatsApp Web format)
            $url = 'https://web.whatsapp.com';

            // Use the preferred browser or default to Chrome
            // $browser = 'google-chrome'; // or 'firefox'
            $browser = '/usr/bin/google-chrome';

            // Proper shell command to open a new browser tab in background
            // $command = sprintf(
            //     '%s --new-tab "%s" > /dev/null 2>&1 &',
            //     $browser,
            //     $url
            // );
            // Build shell command using GUI user (e.g., amidelu)
            $command = sprintf(
                'sudo -u amidelu DISPLAY=:0 %s --new-tab "%s" > /dev/null 2>&1 &',
                $browser,
                $url
            );
            

            // Optional: If you're running as a web server user, make sure DISPLAY is set
            // for GUI apps like Chrome. Most often, it is :0
            putenv("DISPLAY=:0");

            // Execute the command
            shell_exec($command);

            // Optional: return true/false based on command logic or logging
            return true;
        }


        
        // private function openWhatsAppOnServer($phoneNumber)
        // {
        //     try {
        //         $cleanNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        //         $url = "https://web.whatsapp.com/send?phone={$cleanNumber}";
                
        //         // First verify WhatsApp URL is accessible
        //         $httpCode = $this->checkUrl($url);
                
        //         if ($httpCode !== 200) {
        //             Log::error("WhatsApp URL inaccessible. HTTP code: {$httpCode}");
        //             return false;
        //         }

        //         $command = sprintf(
        //             'xvfb-run --auto-servernum --server-args="-screen 0, 1024x768x24" ' .
        //             'chromium-browser --no-sandbox --disable-gpu --new-window %s > /dev/null 2>&1 &',
        //             escapeshellarg($url)
        //         );

        //         exec($command, $output, $returnCode);
                
        //         Log::info('WhatsApp launch attempt', [
        //             'command' => $command,
        //             'return_code' => $returnCode,
        //             'output' => $output
        //         ]);

        //         return $returnCode === 0;
        //     } catch (\Exception $e) {
        //         Log::error('WhatsApp open failed: ' . $e->getMessage());
        //         return false;
        //     }
        // }

        // private function checkUrl($url)
        // {
        //     $ch = curl_init($url);
        //     curl_setopt($ch, CURLOPT_NOBODY, true);
        //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        //     curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //     curl_exec($ch);
        //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //     curl_close($ch);
        //     return $httpCode;
        // }
}
