<?php

namespace App\Console\Commands;

use App\Models\Record;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;

class ImportApiData extends Command
{
    protected $signature = 'import:api-data';
    protected $description = 'Import data from API and save to database';

    public function handle()
    {
        try {
            $client = new Client();
            $response = $client->get('https://api.publicapis.org/entries');
            $data = json_decode($response->getBody(), true);

            foreach ($data['entries'] as $entry) {
                // Validate and create the record if it does not exist
                Record::updateOrCreate(
                    ['email' => $entry['email']],
                    [
                        'name' => $entry['name'],
                        'phone' => $entry['phone'],
                        'address' => $entry['address'],
                    ]
                );
            }

            $this->info('API data imported successfully.');
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                abort(404);
            } else {
                abort(500);
            }
        } catch (Throwable $e) {
            // Send email to tech@nextpayday.co for any exception or error
            Mail::to('tech@nextpayday.co')->send(new ExceptionOccurred($e));

            // Reroute to 404 page
            abort(404);
        }
    }
}
