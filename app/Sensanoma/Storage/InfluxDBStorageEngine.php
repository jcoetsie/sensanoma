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

    /**
     * @param $measurement
     * @param array $params
     * @return array|Collection
     */
    public function read($measurement, Array $params = [])
    {
        $influxBuilder = new InfluxQueryBuilder();

        $query = $influxBuilder
            ->select($params['select'])
            ->from("autogen.{$measurement}")
            ->where($params['where'])
            ->groupBy($params['groupBy'])
            ->fill($params['fill'])
            ->build();

        try{
            $query = InfluxDB::query($query);
        } catch (Exception $e){
            return [
                'error' => $e->getMessage()
            ];
        }

        return new Collection($query->getPoints());
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