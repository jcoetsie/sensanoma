<?php

namespace Tests\Feature;

use App\Sensanoma\Storage\Reader\InfluxReader;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class InfluxReaderTest extends TestCase
{
    protected $influxReader;

    public function setUp()
    {
        parent::setUp();

        $this->influxReader = new InfluxReader();
        Artisan::call('influx:seed', ['--wipe' => true, '--test' => 10]);
    }

    /** @test */
    public function it_should_read_influx_data()
    {
        $result = $this->influxReader->read([
            'select'    => ['*'],
            'from'      => ['air_temp'],
            'where'     => '',
            'groupBy'   => '',
            'fill'      => '',
            'limit'     => 1
        ]);

        $this->assertInstanceOf('Illuminate\Support\Collection', $result);
        $this->assertEquals($result->count(), 1);
    }

    /** @test */
    public function it_should_throw_error_when_reading()
    {
        $result = $this->influxReader->read([
            'select'    => ['asmean(value)'],
            'from'      => ['air_temp'],
            'where'     => '',
            'groupBy'   => '',
            'fill'      => '',
            'limit'     => 0
        ]);

        $this->assertArrayHasKey('error', $result);
    }
}
