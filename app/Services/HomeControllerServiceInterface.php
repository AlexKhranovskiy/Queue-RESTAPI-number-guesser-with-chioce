<?php


namespace App\Services;


use Illuminate\Http\Request;

interface HomeControllerServiceInterface
{
    public function getConfigParams(Request $request);

    public  function show(Request $request);

    public static function clear();

    public function total();

    public function start(Request $request);

    public function result();
}
