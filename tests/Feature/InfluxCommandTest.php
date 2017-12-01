<?php

namespace Tests\Feature;

use App\Sensanoma\Storage\InfluxDBStorageEngine;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class InfluxCommandTest extends TestCase
{
    /** @test */
    public function it_should_seeds_influx_database()
    {
        /*
        $influxStorage = new InfluxDBStorageEngine(new Collection());
        $influxStorage->drop();

        Artisan::call('influx:seed');
        $output = Artisan::output();

        $this->assertEquals("The influxDB has been seeded!", $output);
        */
    }
}
