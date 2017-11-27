<?php

namespace App\Sensanoma\Storage;

interface StorageInterface
{
    public function store();
    public function read($measurement, Array $data);
}