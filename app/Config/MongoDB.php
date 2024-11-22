<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class MongoDB extends BaseConfig
{
    public string $host = 'cluster0.cxxei.mongodb.net';
    public string $port = '';
    public string $username = 'Django';
    public string $password = 'Django123456';
    public string $database = 'reservas';
}
