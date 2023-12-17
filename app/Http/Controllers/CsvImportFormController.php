<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvImportFormController extends Controller
{
    public function showForm()
    {
        return view('csv-import');
    }
}
