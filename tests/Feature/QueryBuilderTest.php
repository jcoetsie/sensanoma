<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Sensanoma\Storage\QueryBuilder;

class QueryBuilderTest extends TestCase
{
    /** @test */
    public function it_should_throw_an_error_when_select_params_is_invalid()
    {
        $builder = (new QueryBuilder\InfluxQueryBuilder)
            ->select([]);
        $this->assertInstanceOf('Exception', $builder);
    }

    /** @test */
    public function it_should_throw_an_error_when_from_params_is_invalid()
    {
        $builder = (new QueryBuilder\InfluxQueryBuilder)
            ->from([]);
        $this->assertInstanceOf('Exception', $builder);
    }

    /** @test */
    public function it_should_build_the_querie()
    {
        $builder = (new QueryBuilder\InfluxQueryBuilder)
            ->select(['*'])
            ->from(['internal_temp'])
            ->where('value > 5')
            ->groupBy('time')
            ->fill('linear')
            ->limit('5')
            ->build();

        $this->assertEquals('SELECT * FROM internal_temp WHERE value > 5 GROUP BY time fill(linear) LIMIT 5', $builder);
    }
}
