<?php

namespace App\Sensanoma\Storage;

class DataPoint
{
    protected $timestamp;
    protected $account_id;
    protected $sensornode_id;
    protected $area;
    protected $zone;
    protected $crop;
    protected $measurement;
    protected $value;

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        if(!is_int($timestamp)) {
            abort(417, 'Invalid time format');
        }
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * @param mixed $account_id
     */
    public function setAccountId($account_id)
    {
        if(!is_int($account_id)) {
            abort(417, 'Invalid int format');
        }
        $this->account_id = $account_id;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     */
    public function setArea($area)
    {
        if(!is_string($area)) {
            abort(417, 'Invalid string format');
        }
        $this->area = $area;
    }

    /**
     * @return mixed
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param mixed $zone
     */
    public function setZone($zone)
    {
        if(!is_string($zone)) {
            abort(417, 'Invalid string format');
        }
        $this->zone = $zone;
    }

    /**
     * @return mixed
     */
    public function getCrop()
    {
        return $this->crop;
    }

    /**
     * @param mixed $crop
     */
    public function setCrop($crop)
    {
        if(!is_string($crop)) {
            abort(417, 'Invalid string format');
        }
        $this->crop = $crop;
    }

    /**
     * @return mixed
     */
    public function getMeasurement()
    {
        return $this->measurement;
    }

    /**
     * @param mixed $measurement
     */
    public function setMeasurement($measurement)
    {
        if(!is_string($measurement)) {
            abort(417, 'Invalid string format');
        }
        $this->measurement = $measurement;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        if(!is_int($value)) {
            abort(417, 'Invalid int format');
        }
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getSensornodeId()
    {
        return $this->sensornode_id;
    }

    /**
     * @param mixed $sensorNode_id
     */
    public function setSensornodeId($sensornode_id)
    {
        if(!is_int($sensornode_id)) {
            abort(417, 'Invalid int format');
        }
        $this->sensornode_id = $sensornode_id;
    }

}