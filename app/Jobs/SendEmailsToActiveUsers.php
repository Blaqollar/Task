<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\SendEmailToUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailsToActiveUsers implements ShouldQueue
{ use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Retrieve active users
        $activeUsers = User::where('is_active', true)->get();

        // Simulate exceptions for demonstration purposes
        $exceptionsCount = 0;

        foreach ($activeUsers as $user) {
            try {
                // Simulate exception for demonstration
                if ($exceptionsCount < 3) {
                    throw new \Exception('Simulated exception');
                }

                // Send email to the active user
                \Mail::to($user->email)->send(new SendEmailToUser($user));
            } catch (\Exception $e) {
                // Log the exception or handle it as needed
                \Log::error('Exception while sending email: ' . $e->getMessage());

                // Increment the exception count
                $exceptionsCount++;
            }
        }

        // Fail the job after 3 exceptions
        if ($exceptionsCount >= 3) {
            $this->fail(new \Exception('Job failed after 3 exceptions.'));
        }
    }
}
