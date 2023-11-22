<?php

namespace App\Orchid\Layouts\Library\Items;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AuthorDataRows extends Rows
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
            Input::make('author.lastname')
                -> title('Фамилия')
                -> required()
                -> placeholder('Введите фамилию автора...'),
            Input::make('author.firstname')
                -> title('Имя')
                -> required()
                -> placeholder('Введите имя автора...'),
            Input::make('author.patronymic')
                -> title('Отчество (при наличии)')
                -> placeholder('Введите отчество автора...'),
            Input::make('author.id')
                -> type('hidden'),
        ];
    }
}
