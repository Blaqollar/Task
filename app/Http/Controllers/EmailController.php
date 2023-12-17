<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmails()
    {
        // Dispatch the job
        SendEmailsToActiveUsers::dispatch();

        return response()->json(['message' => 'Email job dispatched successfully']);
    }
}
