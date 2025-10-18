<?php

namespace App\Controllers;

class MetricsGuide extends BaseController
{

    public function __construct() {}

    public function guideView()
    {
        return view('metricsGuide/metricsGuide');
    }
}
