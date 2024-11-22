<?php

namespace App\Libraries;

use Config\MongoDB;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;


class MongoLibrary
{
    protected Client $client;
    protected Database $database;

    public function __construct()
    {
        $config = new MongoDB();

        $uri = "mongodb+srv://$config->username:$config->password@$config->host/$config->database?retryWrites=true&w=majority";

        $this->client = new Client($uri);
        $this->database = $this->client->{$config->database};
    }

    public function getCollection($collectionName): Collection
    {
        return $this->database->{$collectionName};
    }
}
