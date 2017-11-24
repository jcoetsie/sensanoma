<?php

namespace App\Console\Commands;

use App\Sensanoma\Storage\DataPoint;
use App\Sensanoma\Storage\InfluxDBStorageEngine;
use Illuminate\Console\Command;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;


class influx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'influx:seed
                                {--measurement= : Seed influx with special measurement}
                                {--crop= : Seed influx with special crop}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding the influx Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $options = $this->initializeOptions($this->options());

        $faker = Faker::create();
        $carbon = Carbon::create();
        $dataPoints = new Collection();

        $measurements = [
            'air_temp', 'air_humidity',
            'soil_temp', 'soil_humidity',
            'sun_lumen', 'intern_temp'
        ];

        if (isset($options['measurement'])) {
            foreach ($options['measurement'] as $measurement) {
                array_push($measurements, $measurement);
            }
        }

        $crops = ['Tomato', 'Broccoli', 'Avocado', 'Brussels sprout', 'Carrot', 'Grape'];



        for ($i = 1; $i < 500; $i++) {
            $measurement = array_random($measurements);

            $now = $carbon->min()->subMinutes($i);

            $dataPoint = new DataPoint();
            $dataPoint->setMeasurement($measurement);
            $dataPoint->setValue(random_int(1, 15));
            $dataPoint->setArea($faker->city);
            $dataPoint->setZone($faker->streetName);
            $dataPoint->setAccountId(random_int(1, 15));
            $dataPoint->setSensornodeId(random_int(1, 100));
            $dataPoint->setCrop(array_random($crops));
            $dataPoint->setTimestamp($now->timestamp);
            $dataPoints->push($dataPoint);
        }

        $storage = new InfluxDBStorageEngine($dataPoints);
        $storage->store();
        $this->info('The influxDB has been seeded!');

    }

    public function initializeOptions(array $options)
    {
        $options = [];
        foreach ($this->options() as $key => $value) {
            if ($value) {
                $options[$key] = explode(',', str_replace(' ', '', $value));
            }
        }
        return $options;
    }
}
