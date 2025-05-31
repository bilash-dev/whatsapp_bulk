<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\SenderIdController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function(){

    // Route::get('/dashboard', function(){
    //     return view('layout.sidebar');
    // })->name('dashboard');

    //whatsapp web open route
    Route::get('/whatsapp-session', [AuthController::class, 'whatsappAccounsts'])->name('whatsapp.session');
    Route::post('/open-whatsapp', [AuthController::class, 'openWhatsApp']);
    
    Route::get('/dashboard', [WhatsappController::class, 'index'])->name('dashboard');

    // Route::get('/create-whatsapp-session', [WhatsappController::class, 'createSession'])->name('whatsapp.add');
    Route::get('/create-whatsapp-session', [SenderIdController::class, 'createSession'])->name('senderId.create');
    Route::post('/senders/store', [SenderIdController::class, 'store'])->name('senderId.store');
    
    Route::get('/upload', [CsvController::class, 'uploadIndex'])->name('upload.csv');
    Route::post('/upload/store', [CsvController::class, 'uploadCsv'])-> name('upload.store');

    Route::get('/template', [TemplateController::class, 'createTemplate'])->name('template.create');
    Route::post('/template/store', [TemplateController::class, 'templateStore'])->name('template.store');
    
    Route::get('/campaign-view', [CampaignController::class, 'campaign'])->name('campaign.view');
    Route::post('/campaign/send', [CampaignController::class, 'campaingSend'])->name('campaign.send');
    
    Route::get('/user-list', [WhatsappController::class, 'userList'])->name('user.list');
 
    // Route::get('/open-whatsapp', function () {
    //     if (session('user') === 'admin') {
    //         // Use 'DISPLAY' for GUI apps on Ubuntu
    //         $command = 'DISPLAY=:0 xdg-open https://web.whatsapp.com';
    //         shell_exec($command . ' > /dev/null 2>&1 &');
    //         return response()->json(['status' => 'Browser opened']);
    //     } else {
    //         return response()->json(['error' => 'Unauthorized'], 403);
    //     }
    // });
});

Route::get('/sidebar', function () {
    return view('layout.sidebar');
});

Route::get('/test-shell', function () {
    $output = shell_exec('whoami');
    return 'Shell runs as: ' . $output;
});
