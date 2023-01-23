<?php

namespace App\Services\BooksJson;

use Illuminate\Http\Client\Response;

class SecondBooksJson extends BooksJson
{
    public function getBooks() : array
    {
        // имитация кода $response = Http::get('second-books.com');
        $response = $this->HttpGetSecondBooksCom();

        if (! $this->errorHandlingAndLogging('FirstBooksJson.getBooks', $response)) {
            return [];
        }

        $jsonArray = json_decode($response->content(), true);

        $result = collect($jsonArray)->map(function ($item, $_) {
            return [
                'title' => $item['title'],
                'description' => $item['desc'],
                'author' => $item['author'],
                'createdAt' => Null,
            ];
        });

        return $result->toArray();
    }

    protected function HttpGetSecondBooksCom()
    {
        /**
         * имитация запроса на книжный сервис [ Http::get('second-books.com'); ]
         *
         * выделил в функция чтобы не засорять фун-ю getBooks()
         */
        return response([
            [
                "title" => "Финансит",
                "desc" => "Это книга о человеке, который прежде всего является Финансистом- могучим тигром в мире беззащитных овец и хищных волков.",
                "author" => "Т. Драйзер"
            ],
            [
                "title" => "Таинственный остров",
                "desc" => "В ней повествуется о событиях, происходивших на вымышленном острове, куда забросило на воздушном шаре несколько человек, бежавших из Америки в результате Гражданской войны.",
                "author" => "Жюль Верн"
            ],
            [
                "title" => "Портрет Дориана Грея",
                "desc" => "Тонкий эстет и романтик становится безжалостным преступником. Попытка сохранить свою необычайную красоту и молодость оборачивается провалом. ",
                "author" => "Оскар Уайльд"
            ]
        ], 200);
    }
}
