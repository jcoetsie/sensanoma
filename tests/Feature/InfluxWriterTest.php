<?php

namespace Tests\Feature;

use App\Sensanoma\DataPoint;
use App\Sensanoma\Storage\Writer\InfluxWriter;
use Illuminate\Support\Collection;
use Tests\TestCase;

class InfluxWriterTest extends TestCase
{
    protected $dataPoint;
    protected $dataPoints;
    protected $influxWriter;

    public function setUp()
    {
        parent::setUp();

        $this->dataPoint = new DataPoint();
        $this->dataPoint->setMeasurement('air_temp');
        $this->dataPoint->setValue(random_int(1, 17));
        $this->dataPoint->setArea('area1');
        $this->dataPoint->setZone('zone1');
        $this->dataPoint->setAccountId(random_int(1, 15));
        $this->dataPoint->setSensornodeId(random_int(1, 100));
        $this->dataPoint->setCrop('carrot');
        $this->dataPoint->setTimestamp(time());

        // Make Collection dataPoints
        $this->dataPoints = new Collection();
        $this->dataPoints->push($this->dataPoint);
        $this->influxWriter = new InfluxWriter($this->dataPoints);
        // Drop influx database
        $this->influxWriter->drop();
    }

    /** @test */
    public function it_should_write_point()
    {
        $writePoint = $this->influxWriter->store();
        $this->assertTrue($writePoint);
    }
}
