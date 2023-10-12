<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class InsertCsvController extends Controller
{
  
    public function insertFromCsv()
    {
        $filePath = public_path('csv/users.csv');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'CSV file not found'], 404);
        }

        $data = array_map('str_getcsv', file($filePath));

        foreach ($data as $row) {

            // Check if email is provided and not empty
            if (!empty($row[2])) {
                $validator = Validator::make([
                    'email' => $row[2], 
                    'phone' => $row[3], 
                ], [
                    'email' => 'required|unique:children,email,NULL,id,phone,' . $row[3],
                    'phone' => 'required|unique:children,phone,NULL,id,email,' . $row[2],
                ]);

                if ($validator->fails()) {
                    // Handle duplicates (email or phone already exists)
                    \Log::info('Duplicate entry: Email - ' . $row[2] . ', Phone - ' . $row[3]);
                    continue;
                }
            } else {
                // Handle case where email is not provided
                \Log::warning('Email is not provided for record. Skipping.');
                continue;
            }

            try {
                // Insert a new user record
                Child::create([
                    'first_name' => $row[0],
                    'last_name' => $row[1],
                    'email' => $row[2],
                    'phone' => $row[3],
                    'company' => $row[4],
                    'city' => $row[5],
                    'country' => $row[6],
                ]);
            } catch (QueryException $e) {
                // Catch the specific exception for duplicate entry
                if ($e->errorInfo[1] === 1062) {
                    \Log::info('Duplicate entry: Email - ' . $row[2] . ', Phone - ' . $row[3]);
                    continue;
                }
                // Handle other exceptions if needed
                \Log::error('Error inserting record: ' . $e->getMessage());
            }
        }

        return response()->json(['message' => 'Data inserted successfully']);
    }
}

