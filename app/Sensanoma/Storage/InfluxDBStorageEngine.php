<?php

namespace App\Sensanoma\Storage;


use Illuminate\Support\Collection;
use InfluxDB\Client\Exception;
use InfluxDB\Point;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class InfluxDBStorageEngine implements StorageInterface
{

    protected $dataPoints;

    /**
     * InfluxDBStorageEngine constructor.
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

    public function read($measurement)
    {
        try{
            $query = InfluxDB::query('SELECT mean(value) FROM autogen.' .$measurement. ' WHERE time > now() - 10d GROUP BY time(30m) fill(linear)');
        } catch (Exception $e){
            return [
                'error' => $e->getMessage()
            ];
        }

        return $query->getPoints();

    }

    public function drop() {
        InfluxDB::drop();
    }

    private function createIfNotExist()
    {
        if(!InfluxDB::exists()){
            InfluxDB::create();
        }
    }



}