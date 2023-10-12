<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Work;

class ParseDataController extends Controller
{
   
    public function ParseData()
            {
            $filePath = public_path('data/data.php');

            // Check if the file exists
            if (!file_exists($filePath)) {
                return response()->json(['error' => 'File not found'], 404);
            }

            // Attempt to include the PHP file
            $data = include($filePath);

            // Check if the included data is an array
            if (!is_array($data)) {
                return response()->json(['error' => 'Invalid data format in the file', 'data' => $data], 500);
            }

            $currentDateTime = Carbon::parse('2023-10-06 23:10:00');

            // Filter the data
            $filteredData = collect($data)->filter(function ($item) use ($currentDateTime) {
                return isset($item['status']) && $item['status'] === 'pending' &&
                    isset($item['expired_at']) && Carbon::parse($item['expired_at'])->greaterThan($currentDateTime);
            });

            dd($filteredData);
            return response()->json(['filtered_data' => $filteredData->all()], 200);
    }

    function removeData(){
            $filePath = public_path('data/data.php');

            $data = include($filePath);

             // Filter the data where status failed and cancelled
             $removeData = collect($data)->filter(function ($item){
                return isset($item['status']) &&  ($item['status'] === 'cancelled' || $item['status'] === 'failed');
              
                    
            })->all();

            dd($removeData);

    }

    function paidData(){
        $filePath = public_path('data/data.php');

        $data = include($filePath);

         // Filter the data where status failed and cancelled
         $filteredData = collect($data)->filter(function ($item){
            return isset($item['status']) &&  $item['status'] === 'paid' ;
          
                
        });

        dd($filteredData);
    }


    // insert all data into works db
    function worksInsert(){
        $filePath = public_path('data/data.php');

        // Check if the file exists
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Attempt to include the PHP file
        $data_list = include($filePath);

        
        
        foreach($data_list as $key=>$data){
            
           $dataToInsert =[
                'key' => $key,
                'array_id' =>$data['id'],
                'booked_at' => $data['booked_at'],
                'expired_at' => $data['expired_at'],
                'status' => $data['status']
                
           ];

            
            Work::create($dataToInsert);
            // dd($data['id']);

            return response()->json(['success' => "All data inserted succesfully!"]);
        }
        


    }


        
}
