<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CsvImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $csvData = array_map('str_getcsv', file($file));

        foreach ($csvData as $row) {
            $record = [
                'name' => $row[1],
                'email' => $row[2],
                'phone' => $row[3],
                'address' => $row[4],
            ];

            // Validate and create the record if it does not exist
            Record::updateOrCreate(
                ['email' => $record['email']],
                $record
            );
        }

        return response()->json(['message' => 'CSV imported successfully']);
    }
}
