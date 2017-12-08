<?php

namespace Tests\Feature;

use App\Sensanoma\DataPoint;
use App\Sensanoma\Storage\Reader\InfluxReader;
use App\Sensanoma\Storage\Writer\InfluxWriter;
use Illuminate\Support\Collection;
use Tests\TestCase;

class StorageTest extends TestCase
{

    public $dataPoint;

    public function setUp()
    {
        parent::setUp();

        // Make dataPoint
        $this->dataPoint = new DataPoint();
    }

    /** @test */
    public function it_should_correctly_hydrate_datapoint()
    {
        $datapoint = new DataPoint([
            'measurement'   => 'a',
            'accountId'    => 1,
            'sensornodeId' => 1,
            'area'          => 'a',
            'zone'          => 'a',
            'crop'          => 'a',
            'value'         => 1,
            'timestamp'     => time()
        ]);

        $this->assertInstanceOf('App\Sensanoma\DataPoint', $datapoint);
        $this->assertEquals($datapoint, $datapoint);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_measurement()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setMeasurement(123);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_timeStamp()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setTimestamp('test!');
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_accountId()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setAccountId('Test');
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_area()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setArea(123);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_zone()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setZone(123);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_crop()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setCrop(123);
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_value()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setValue('Test!');
    }

    /** @test */
    public function it_should_throw_error_when_inserting_invalid_sensorNodeId()
    {
        $this->expectException('Symfony\Component\HttpKernel\Exception\HttpException');

        $this->dataPoint->setSensornodeId('Test');
    }
}
