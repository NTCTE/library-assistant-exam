<?php

namespace App\Orchid\Layouts\Library\Items;

use App\Models\Library\Items\Publishing;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PublishingsTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'publishings';

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
                -> render(fn(Publishing $publishing) => DropDown::make()
                    -> icon('bs.three-dots')
                    -> list([
                        ModalToggle::make('Изменить')
                            -> icon('bs.pencil-square')
                            -> modalTitle('Изменение издательства')
                            -> modal('publishingMeta')
                            -> method('createUpdatePublishing')
                            -> asyncParameters([
                                'name' => $publishing -> name,
                                'id' => $publishing -> id,
                            ]),
                        Button::make('Удалить')
                            -> icon('bs.trash')
                            -> confirm('Вы действительно хотите удалить издательство? Если у издательства есть книги, то они также будут удалены.')
                            -> method('remove', [
                                'id' => $publishing -> id,
                            ]),
                    ])),
        ];
    }
}
