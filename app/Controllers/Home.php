<?php

namespace App\Controllers;

use App\Libraries\MongoLibrary;

class Home extends BaseController
{
    protected MongoLibrary $mongo;

    public function __construct()
    {
        $this->mongo = new MongoLibrary();
    }

    public function index(): string
    {
        return view('welcome_message');
    }

    public function home(): string
    {
        $collection = $this->mongo->getCollection('room');
        $documents = $collection->find()->toArray();
        $rooms = array_map(fn($doc) => $doc->getArrayCopy(), $documents);

        return view('home', ['rooms' => $rooms]);
    }

}
