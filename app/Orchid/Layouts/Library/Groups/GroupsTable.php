<?php

namespace App\Orchid\Layouts\Library\Groups;

use App\Models\Library\Readers\Group;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class GroupsTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'groups';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Название группы'),
            TD::make('actions', 'Действия')
                -> render(fn (Group $group) => DropDown::make()
                    -> icon('bs.three-dots')
                    -> list([
                        ModalToggle::make('Редактировать')
                            -> icon('bs.pencil')
                            -> modal('createUpdateGroupModal')
                            -> method('createUpdateGroup')
                            -> modalTitle('Редактирование группы студентов')
                            -> asyncParameters([
                                'id' => $group -> id,
                            ]),
                        Button::make('Удалить')
                            -> icon('bs.trash')
                            -> confirm('Вы действительно хотите удалить данную группу студентов? Студенты при этом не будут удалены.')
                            -> method('remove', [
                                'id' => $group -> id,
                            ]),
                    ]))
        ];
    }
}
