<?php

namespace App\Services\BooksJson;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

abstract class BooksJson
{
    abstract public function getBooks() : array;

    public function errorHandlingAndLogging(string $serviceName, Response $response) : bool
    {
        if ($response->status() >= 200 and $response->status() < 400) {
            Log::info("Service [ $serviceName ] worked successfully");

            return true;
        }

        if ($response->status() >= 400 and $response->status() < 500) {
            Log::warning("Service [ $serviceName ] failed (client error)");
        } else if ($response->status() == 500) {
            Log::info("Service [ $serviceName ] failed (server error)");
        } else {
            Log::alert("Service [ $serviceName ] failed (?)");
        }

        return false;
    }
}
