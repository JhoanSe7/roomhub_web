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
        $data = array(
            "content" => "Tu destino para reservas rápidas, seguras y con las mejores ofertas.",
            "page" => view(__function__),
        );
        return view('page', $data);
    }

    public function home(): string
    {
        $collection = $this->mongo->getCollection('room');
        $documents = $collection->find()->toArray();
        $rooms = array_map(fn($doc) => $doc->getArrayCopy(), $documents);

        $data = array(
            "content" => "Encuentra la habitación perfecta para tu estadía",
            "page" => view(__function__, ['rooms' => $rooms]),
        );
        return view('page', $data);
    }

    public function booking(): string
    {
        $collection = $this->mongo->getCollection('room');
        $documents = $collection->find(['available' => true])->toArray();
        $rooms = array_map(fn($doc) => $doc->getArrayCopy(), $documents);
        $data = array(
            "content" => "Completa el formulario para confirmar tu reserva.",
            "page" => view(__function__, ['rooms' => $rooms]),
        );
        return view('page', $data);
    }

    public function contact(): string
    {
        $data = array(
            "content" => "Estamos aquí para ayudarte. ¿Tienes dudas o comentarios? ¡Escríbenos!",
            "page" => view(__function__),
        );
        return view('page', $data);
    }

}
