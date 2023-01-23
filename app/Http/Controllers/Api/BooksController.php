<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BooksJson\BooksJson;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function getBooksJson(Request $request)
    {
        $request->validate([
            'serviceNames' => ['array']
        ]);

        $booksJsons = [];
        foreach ($request['serviceNames'] as $serviceName) {
            $booksJson = app()->make(BooksJson::class)($serviceName);

            $booksJsons = collect($booksJsons)->concat(collect($booksJson->getBooks()))->toArray();
        }

        return response($booksJsons, 200);
    }
}
