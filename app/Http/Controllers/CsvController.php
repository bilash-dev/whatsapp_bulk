<?php

namespace App\Http\Controllers;

use App\Models\CsvUpload;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    
    public function uploadIndex(){
        return view('page.upload');
    }
    
    
    public function uploadCsv(Request $request){

        try{

            $validated = $request->validate([
                'csvFile_name' => 'required|mimes:csv,txt',
            ]);
    
            // Store the file in storage/app/public/csv_files
            $file = $request->file('csvFile_name');
    
           
            $filename = 'phone_numbers_' . now()->format('Ymd_His') . '.' .$file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/', $filename);
     
            // Parse CSV and insert phone numbers
            $absolutePath = storage_path('app/' . $filePath);
            $data = array_map('str_getcsv', file($absolutePath));
           
            $inserted = false;
            foreach ($data as $row) {
                if (!empty($row[0])) {
                    CsvUpload::firstOrCreate([
                        'csvFile_name' => $filePath,
                        'numbers' => trim($row[0]),
                    ]);

                    $inserted = true;
                }
            }

            if($inserted){
                return redirect()->route('create.template')->with('success', 'CSV file & phone numbers inserted.');
            }else{
                return back()->with('error', 'CSV file is empty or contains invalid data.');
            }
        }catch (\Exception $e){
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
        
    }
}
