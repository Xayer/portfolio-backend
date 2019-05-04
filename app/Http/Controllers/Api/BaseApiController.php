<?php
/**
 * Created by PhpStorm.
 * User: frederikrabol
 * Date: 03/05/2019
 * Time: 20.44
 */

namespace App\Controllers\Api;


use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    public function __construct()
    {
        $this->setupFractalIncludeListener();
    }

    public function setupFractalIncludeListener()
    {
        $fractal = new Fractal\Manager();

        if (isset($_GET['include'])) {
            $fractal->parseIncludes($_GET['include']);
        }
    }
}
