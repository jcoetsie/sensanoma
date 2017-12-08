<?php

namespace App\Sensanoma\Storage\Reader;


use App\Sensanoma\Storage\QueryBuilder\InfluxQueryBuilder;
use App\Sensanoma\Storage\StorageReaderInterface;
use Illuminate\Support\Collection;
use TrayLabs\InfluxDB\Facades\InfluxDB;

class InfluxReader implements StorageReaderInterface
{
    /**
     * @param array $params
     * @return array|Collection
     */
    public function read(Array $params = [])
    {
        $influxBuilder = new InfluxQueryBuilder();

        $query = $influxBuilder
            ->select($params['select'])
            ->from($params['from'])
            ->where($params['where'])
            ->groupBy($params['groupBy'])
            ->fill($params['fill'])
            ->limit($params['limit'])
            ->build();

        try{
            $query = InfluxDB::query($query);
        } catch (\Exception $e){
            return [
                'error' => $e->getMessage()
            ];
        }
        return new Collection($query->getSeries());
    }
}