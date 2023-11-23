<?php

namespace App\Orchid\Layouts\Library\Items;

use App\Models\Library\Items\TypeOfBook;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TypeOfBooksTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'types_of_books';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Полное имя'),
            TD::make('actions', 'Действия')
                -> render(fn (TypeOfBook $type) => DropDown::make()
                    -> icon('bs.three-dots')
                    -> list([
                        ModalToggle::make('Изменить')
                            -> icon('bs.pencil-square')
                            -> modalTitle('Изменение типа экземпляра')
                            -> modal('typeOfBookMeta')
                            -> method('createUpdateTypeOfBook')
                            -> asyncParameters([
                                'name' => $type -> name,
                                'id' => $type -> id,
                            ]),
                        Button::make('Удалить')
                            -> icon('bs.trash')
                            -> confirm('Вы действительно хотите удалить тип экземпляра? Если у типа экземпляра есть книги, то они также будут удалены.')
                            -> method('remove', [
                                'id' => $type -> id,
                            ]),
                    ])),
        ];
    }
}
