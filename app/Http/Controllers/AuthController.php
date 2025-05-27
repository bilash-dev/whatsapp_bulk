<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Process;
use Symfony\Component\Process\Process;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }


    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        
        return back()->withErrors([
            'username' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function whatsappAccounsts(){
        return view('whatsapp-session');
    }


   

    // public function openWhatsApp(Request $request){
    //     $user = Auth::user();
    //     $command = match($user->browser_preference){
    //             'firefox' => ['firefox', '-new-tab', 'https://web.whatsapp.com'],
    //             'google-chrome' => ['google-chrome', '--new-tab', 'https://web.whatsapp.com'],
    //             // default => ['google-chrome', '--new-tab', 'https://web.whatsapp.com']
    //         };
    //         $process  = new Process($command);
    //         $process->start();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'WhatsApp opened in ' . $user->browser_preference,
    //         ]);
        
    // }


    // public function openWhatsApp(Request $request)
    // {
    //     // Verify user is authenticated
    //     if (!auth()->check()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthorized'
    //         ], 401);
    //     }

    //     $user = auth()->user();
    //     $browser = $user->browser_preference === 'firefox' ? 'firefox' : 'google-chrome';
    //     $command = $browser === 'firefox' 
    //         ? ['firefox', '-new-tab', 'https://web.whatsapp.com']
    //         : ['google-chrome', '-new-tab', 'https://web.whatsapp.com'];

    //     try {
    //         $process = new Process($command);
    //         $process->start();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'WhatsApp opened in ' . $browser
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to launch browser: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }



    public function openWhatsApp(Request $request)
    {
        $user = auth()->user();
        $browser = $user->browser_preference === 'firefox' ? 'firefox' : 'google-chrome';
        
        // Use shell_exec for more direct control
        $command = sprintf(
            '%s %s https://web.whatsapp.com > /dev/null 2>&1 &',
            $browser,
            $user->browser_preference === 'firefox' ? '-new-tab' : '--new-tab'
        );
        
        shell_exec($command);
        
        return response()->json([
            'success' => true,
            'message' => 'WhatsApp opened in ' . $browser,
            'command' => $command
        ]);
    }
    
}
