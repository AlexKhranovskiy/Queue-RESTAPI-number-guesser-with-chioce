<?php


namespace App\Services;


use Illuminate\Http\Request;

interface HomeControllerServiceInterface
{
    public function getConfigParams(Request $request);

    public static function show(Request $request);

    public static function clear();

    public static function total();

    public function start(Request $request);

    public function result();

    public function cancel();
}
