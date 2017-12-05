<?php

namespace App\Sensanoma\Storage\Writer;


use App\Sensanoma\Storage\StorageWriterInterface;

class MySQLWriter implements StorageWriterInterface
{
    protected $dataPoints;

    public function __construct(Collection $dataPoints)
    {
        $this->dataPoints = $dataPoints;
    }

    public function store()
    {
        foreach ($this->dataPoints as $dataPoint)
        {
            $query = DB::table($dataPoint->getMeasurement())->insert([
                'area'          => $dataPoint->getArea(),
                'zone'              => $dataPoint->getZone(),
                'crop'              => $dataPoint->getCrop(),
                'sensor_node'       => $dataPoint->getSensornodeId(),
                'account_id'        => $dataPoint->getAccountId(),
                'value'             => $dataPoint->getValue(),
                'time'              => date("Y-m-d H:i:s", $dataPoint->getTimestamp())
            ]);
            return $query;
        }
    }
}