<?php

namespace App\Sensanoma\Storage\QueryBuilder;


class InfluxQueryBuilder
{
    protected $select;
    protected $from;
    protected $where;
    protected $groupBy;
    protected $fill;
    protected $limit;

    public function select(Array $fields)
    {
        if (!$fields) {
            return new \Exception('Fields is required');
        }
        $this->select = implode(', ', $fields);
        return $this;
    }

    public function from(Array $measurements)
    {
        if (!$measurements) {
            return new \Exception('Measurements is required');
        }
        $measurements = implode(", ", $measurements);

        $this->from = $measurements;
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

    public function limit($limit = null) {
        ($limit) ? $this->limit = $limit : $this->limit = 0;
        return $this;
    }

    public function build()
    {
        return trim("SELECT $this->select FROM $this->from WHERE $this->where $this->groupBy $this->fill LIMIT $this->limit");
    }
}