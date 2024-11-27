<?php

namespace App\Controllers;

use App\Libraries\MongoLibrary;
use Ramsey\Uuid\Uuid;

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

    public function create()
    {
        $json = $this->request->getJSON();

        try {
            $uuid = Uuid::uuid4()->toString();
            $mongoRoom = $this->mongo->getCollection('room');
            $mongoRoom->updateOne(
                ['code' => $json->room],
                ['$set' => ['available' => 0]]
            );
            $room = $mongoRoom->findOne(['code' => $json->room]);

            $data = [
                'code' => 'RF' . $uuid,
                'client' => $json->fullName,
                'startDate' => $json->checkInDate,
                'endDate' => $json->checkOutDate ?: null,
                'room' => $room,
                'description' => $json->description ?: null,
            ];

            $collection = $this->mongo->getCollection('booking');
            $collection->insertOne($data);

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Reserva creada exitosamente.',
                'data' => $data
            ])->setStatusCode(200);
        } catch (Exception $e) {
            // Manejar errores
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Error al crear la reserva: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
