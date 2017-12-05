<?php

namespace App\Sensanoma\Storage\Writer;

use App\Sensanoma\Storage\StorageWriterInterface;
use Illuminate\Support\Collection;
use InfluxDB\Point;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class InfluxWriter implements StorageWriterInterface
{
    protected $dataPoints;


    /**
     * InfluxWriter constructor.
     * @param Collection $dataPoints
     */
    public function __construct(Collection $dataPoints)
    {
        $this->dataPoints = $dataPoints;
    }

    /**
     * Store data to influxDB
     * @return mixed
     */
    public function store()
    {
        $this->createIfNotExist();

        $points = [];

        foreach ($this->dataPoints as $dataPoint) {
            $points[] =
                new Point(
                    $dataPoint->getMeasurement(),
                    $dataPoint->getValue(),
                    [
                        'area'          => $dataPoint->getArea(),
                        'zone'          => $dataPoint->getZone(),
                        'account_id'    => $dataPoint->getAccountId(),
                        'sensor_node'   => $dataPoint->getSensornodeId()
                    ],
                    [
                        'crop'          => $dataPoint->getcrop(),
                    ],
                    $dataPoint->getTimestamp()
                );
        }
        return InfluxDB::writePoints($points, \InfluxDB\Database::PRECISION_SECONDS);
    }

    /**
     * Drop database
     */
    public function drop() {
        InfluxDB::drop();
    }

    /**
     * Create database if the database doesnt exist
     */
    private function createIfNotExist()
    {
        if(!InfluxDB::exists()){
            InfluxDB::create();
        }
    }
}