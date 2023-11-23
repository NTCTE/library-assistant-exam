<?php

namespace App\Orchid\Layouts\Library\Groups;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class GroupRows extends Rows
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
            Input::make('group.name')
                -> title('Название группы')
                -> required()
                -> placeholder('Введите название группы...'),
            Input::make('group.id')
                -> type('hidden'),
        ];
    }
}
