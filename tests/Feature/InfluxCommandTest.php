<?php

namespace Tests\Feature;

use App\Sensanoma\Storage\Reader\InfluxReader;
use App\Sensanoma\Storage\Writer\InfluxWriter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class InfluxCommandTest extends TestCase
{
    protected $influxWriter;
    protected $influxReader;

    public function setUp()
    {
        parent::setUp();

        $this->influxWriter = new InfluxWriter(new Collection());
        $this->influxReader = new InfluxReader();
    }
    /** @test */
    public function it_should_seeds_influx_database()
    {
        $this->influxWriter->drop();

        Artisan::call('influx:seed');

        $output = Artisan::output();

        $this->assertEquals($output, "The influxDB has been seeded!\n");
    }

    /** @test */
    public function it_should_wipe_date_before_seeds_influx_database()
    {
        $this->influxWriter->drop();

        Artisan::call('influx:seed', ['--wipe' => true]);

        $output = Artisan::output();

        $this->assertEquals($output, "Erasing data..\nThe influxDB has been seeded!\n");
    }

    /** @test */
    public function it_should_seeds_influx_database_with_tomato_as_crop()
    {
        $this->influxWriter->drop();

        Artisan::call('influx:seed', ['--crop' => 'Tomato']);
        $output = Artisan::output();

        $query = $this->influxReader->read([
            'select'    => ['*'],
            'from'      => ['air_temp'], //
            'where'     => '',
            'groupBy'   => '',
            'fill'      => '',
            'limit'     => 1
        ]);

        $result = collect($query->collapse()->get('values'))->collapse()->get(3);

        $this->assertEquals($output, "The influxDB has been seeded!\n");
        $this->assertEquals($result, 'Tomato');
    }

    /** @test */
    public function it_should_seeds_influx_database_with_h2o_as_measurement()
    {
        $this->influxWriter->drop();

        Artisan::call('influx:seed', ['--measurement' => 'h2o']);
        $output = Artisan::output();

        $query = $this->influxReader->read([
            'select'    => ['*'],
            'from'      => ['h2o'], //
            'where'     => '',
            'groupBy'   => '',
            'fill'      => '',
            'limit'     => 1,
        ]);

        $this->assertEquals($output, "The influxDB has been seeded!\n");
        $this->assertEquals($query->count(), 1);
    }
}
