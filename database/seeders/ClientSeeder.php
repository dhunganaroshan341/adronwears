<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::factory()->count(10)->make(); // generate but don't insert yet

        foreach ($clients as $client) {
            Client::updateOrCreate(
                ['email' => $client->email], // condition
                $client->toArray()           // data to insert/update
            );
        }
    }

}
