<?php

namespace App\Services\BooksJson;

class FirstBooksJson extends BooksJson
{
    public function getBooks() : array
    {
        // имитация кода $response = Http::get('first-books.com');
        $response = $this->HttpGetFirstBooksCom();

        if (! $this->errorHandlingAndLogging('FirstBooksJson.getBooks', $response)) {
            return [];
        }

        $jsonArray = json_decode($response->content(), true);

        $result = collect($jsonArray['data'])->map(function ($item, $_) {
            return [
                'title' => $item['name'],
                'description' => $item['description'],
                'author' => Null,
                'createdAt' => $item['createdAt'],
            ];
        });

        return $result->toArray();
    }

    protected function HttpGetFirstBooksCom()
    {
        /**
         * имитация запроса на книжный сервис [ Http::get('first-books.com'); ]
         *
         * выделил в функция чтобы не засорять фун-ю getBooks()
         */
        return response([
            "data" => [
                [
                    "name" => "Война и мир",
                    "description" => "роман-эпопея Льва Николаевича Толстого, описывающий русское общество в эпоху войн против Наполеона в 1805—1812 годах.",
                    "createdAt" => "2022-06-30"
                ],
                [
                    "name" => "Ревизор",
                    "description" => "комедия в пяти действиях, написанная Н. В. Гоголем в 1835 г.",
                    "createdAt" => "2022-05-11"
                ],
                [
                    "name" => "Горе от ума",
                    "description" => "комедия в стихах Александра Сергеевича Грибоедова. Она сочетает в себе элементы классицизма и новых для начала XIX века романтизма и реализма.",
                    "createdAt" => "2022-07-18"
                ]
            ]
        ], 200);
    }
}
