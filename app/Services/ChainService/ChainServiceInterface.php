<?php


namespace App\Services\ChainService;


use Illuminate\Http\Request;

interface ChainServiceInterface
{
    public function show(Request $request);
    public function result();
}
