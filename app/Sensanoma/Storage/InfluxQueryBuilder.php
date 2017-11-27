<?php

namespace App\Sensanoma\Storage;


class InfluxQueryBuilder
{
    protected $select;
    protected $from;
    protected $where;
    protected $groupBy;
    protected $fill;

    public function select($field)
    {
        $this->select = $field;
        return $this;
    }

    public function from($measurement)
    {
        $this->from = $measurement;
        return $this;
    }

    public function where($clause)
    {
        $this->where = $clause;
        return $this;
    }

    public function groupBy($clauseGroup)
    {
        if ($clauseGroup) {
            $this->groupBy = "GROUP BY $clauseGroup";
        }
        return $this;
    }

    public function fill($fill)
    {
        if ($fill) {
            $this->fill = "fill($fill)";
        }
        return $this;
    }

    public function build()
    {
        return trim("SELECT $this->select FROM $this->from WHERE $this->where $this->groupBy $this->fill");
    }
}