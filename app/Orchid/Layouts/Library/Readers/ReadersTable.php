<?php

namespace App\Orchid\Layouts\Library\Readers;

use App\Models\Library\Readers\Reader;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ReadersTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'readers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('fullname', 'ФИО'),
            TD::make('type_of_reader', 'Тип читателя')
                -> render(fn(Reader $reader) => Reader::$types[$reader -> type_of_reader]),
            TD::make('can_get_books', 'Может получать книги')
                -> render(fn(Reader $reader) => $reader -> can_get_books ? 'Да' : 'Нет'),
            TD::make('actions', 'Действия')
                -> render(fn(Reader $reader) => DropDown::make()
                    -> icon('bs.three-dots')
                    -> list([
                        ModalToggle::make('Редактировать')
                            -> icon('bs.pencil')
                            -> modal('createUpdateReaderModal')
                            -> method('createUpdateReader')
                            -> modalTitle('Редактирование читателя')
                            -> asyncParameters([
                                'id' => $reader -> id,
                            ]),
                        Button::make('Удалить')
                            -> icon('bs.trash')
                            -> method('remove')
                            -> confirm('Вы действительно хотите удалить читателя?')
                            -> parameters([
                                'id' => $reader -> id,
                            ]),
                    ])),
        ];
    }
}
