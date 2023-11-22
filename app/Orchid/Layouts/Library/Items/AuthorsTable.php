<?php

namespace App\Orchid\Layouts\Library\Items;

use App\Models\Library\Items\Author;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AuthorsTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'authors';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('fullname', 'Полное имя'),
            TD::make('actions', 'Действия')
                -> render(fn(Author $author) => DropDown::make()
                    -> icon('bs.three-dots')
                    -> list([
                        ModalToggle::make('Изменить')
                            -> icon('bs.pencil-square')
                            -> modalTitle('Изменение автора')
                            -> modal('authorMeta')
                            -> method('createUpdateAuthor')
                            -> asyncParameters([
                                'lastname' => $author -> lastname,
                                'firstname' => $author -> firstname,
                                'patronymic' => $author -> patronymic,
                                'id' => $author -> id,
                            ]),
                        Button::make('Удалить')
                            -> icon('bs.trash')
                            -> confirm('Вы действительно хотите удалить автора? Если у автора есть книги, то они также будут удалены.')
                            -> method('remove', [
                                'id' => $author -> id,
                            ]),
                    ])),
        ];
    }
}
