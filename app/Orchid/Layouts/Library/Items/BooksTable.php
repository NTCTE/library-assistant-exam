<?php

namespace App\Orchid\Layouts\Library\Items;

use App\Models\Library\Items\Book;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BooksTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'books';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('fullname', 'Название'),
            TD::make('author', 'Автор')
                -> render(fn (Book $book) => $book -> author -> fullname),
            TD::make('count_of_sheets', 'Количество страниц'),
            TD::make('count_of_items', 'Количество экземпляров (учетные)'),
            TD::make('actions', 'Действия')
                -> render(fn (Book $book) => DropDown::make()
                    -> icon('bs.three-dots')
                    -> list([
                        ModalToggle::make('Редактировать')
                            -> icon('bs.pencil-square')
                            -> modal('bookMeta')
                            -> modalTitle('Редактирование экземпляра')
                            -> method('createUpdateBook')
                            -> asyncParameters([
                                'id' => $book -> id,
                            ]),
                        Button::make('Удалить')
                            -> icon('bs.trash')
                            -> method('remove')
                            -> confirm('Вы действительно хотите удалить экземпляр?')
                            -> parameters([
                                'id' => $book -> id,
                            ]),
                    ])),
        ];
    }
}
