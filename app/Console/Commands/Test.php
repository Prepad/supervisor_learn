<?php

namespace App\Console\Commands;

use App\Models\Tweet;
use App\Models\User;
use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:elastic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $data = User::all()->toArray();
        $data = Tweet::all()->toArray();
        $client = ClientBuilder::create()
            ->setHosts(['172.22.0.7:9200'])
            ->build();
        foreach ($data as $datum) {
            $params = [
                'index' => 'tweets',
                'body' => $datum,
            ];
            $client->index($params);
        }
    }
}
