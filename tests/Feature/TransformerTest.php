<?php

namespace Tests\Feature;

use App\Sensanoma\Storage\Reader\InfluxReader;
use App\Sensanoma\Transformer\ConsoleTvChartTransformer;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TransformerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('influx:seed', ['--wipe' => true, '--test'=> true]);
    }

    /** @test **/
    public function it_should_transform_for_ConsoleTvCharts()
    {
        $reader = (new InfluxReader)->read([
            'select'    => ['mean(value)'],
            'from'      => ['air_temp', 'air_humidity', 'soil_temp', 'soil_humidity', 'intern_temp', 'sun_lumen'], //
            'where'     => 'time > now() - 5d',
            'groupBy'   => 'time(5h)',
            'fill'      => 'linear',
            'limit'     => 2
        ]);

        $transform = (new ConsoleTvChartTransformer)->transform($reader, Charts::multi('line', 'highcharts'));
        $this->assertcount(6, $transform->datasets);

        foreach ($transform->datasets as $dataset) {
            $this->assertArrayHasKey('label', $dataset);
            $this->assertArrayHasKey('values', $dataset);

        }
    }

    /** @test **/
    public function it_should_failed_transform_for_ConsoleTvCharts()
    {
        $reader = (new InfluxReader)->read([
            'select'    => ['d'],
            'from'      => ['u'], //
            'where'     => 'm',
            'groupBy'   => 'm',
            'fill'      => 'y',
            'limit'     => -2
        ]);

        $transform = (new ConsoleTvChartTransformer)->transform($reader, Charts::multi('line', 'highcharts'));
        $this->assertContains('error parsing query:', $transform);
    }
}
