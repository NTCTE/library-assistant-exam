<?php

namespace App\Orchid\Layouts\Library\Items;

use App\Models\Library\Items\Author;
use App\Models\Library\Items\Publishing;
use App\Models\Library\Items\TypeOfBook;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class BooksDataRows extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('book.fullname')
                -> title('Название экземпляра')
                -> placeholder('Введите название экземпляра...')
                -> required(),
            Relation::make('book.type_of_book_id')
                -> title('Тип экземпляра')
                -> placeholder('Выберите тип экземпляра...')
                -> required()
                -> fromModel(TypeOfBook::class, 'name', 'id'),
            Relation::make('book.author_id')
                -> title('Автор экземпляра')
                -> placeholder('Выберите автора экземпляра...')
                -> required()
                -> fromModel(Author::class, 'fullname', 'id'),
            Relation::make('book.publishing_id')
                -> title('Издательство экземпляра')
                -> placeholder('Выберите издательство экземпляра...')
                -> required()
                -> fromModel(Publishing::class, 'name', 'id'),
            Input::make('book.year_of_publishing')
                -> title('Год издания экземпляра')
                -> placeholder('Введите год издания экземпляра...')
                -> type('number')
                -> mask([
                    'alias' => 'numeric',
                    'digits' => 0,
                    'digitsOptional' => false,
                    'placeholder' => '0',
                ])
                -> required(),
            Input::make('book.count_of_sheets')
                -> title('Количество страниц экземпляра')
                -> placeholder('Введите количество страниц экземпляра...')
                -> type('number')
                -> mask([
                    'alias' => 'numeric',
                    'digits' => 0,
                    'digitsOptional' => false,
                    'placeholder' => '0',
                ])
                -> required(),
            Input::make('book.count_of_items')
                -> title('Количество экземпляра')
                -> placeholder('Введите количество экземпляра...')
                -> value(1)
                -> type('number')
                -> mask([
                    'alias' => 'numeric',
                    'digits' => 0,
                    'digitsOptional' => false,
                    'placeholder' => '0',
                ])
                -> required(),
            Input::make('book.id')
                -> type('hidden'),
        ];
    }
}
