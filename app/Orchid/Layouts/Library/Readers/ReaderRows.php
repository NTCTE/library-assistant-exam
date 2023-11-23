<?php

namespace App\Orchid\Layouts\Library\Readers;

use App\Models\Library\Readers\Group;
use App\Models\Library\Readers\Reader;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class ReaderRows extends Rows
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
            Input::make('reader.lastname')
                -> title('Фамилия')
                -> required()
                -> placeholder('Введите фамилию читателя...'),
            Input::make('reader.firstname')
                -> title('Имя')
                -> required()
                -> placeholder('Введите имя читателя...'),
            Input::make('reader.patronymic')
                -> title('Отчество (при наличии)')
                -> placeholder('Введите отчество читателя...'),
            Select::make('reader.type_of_reader')
                -> title('Тип читателя')
                -> options(Reader::$types)
                -> empty('Выберите тип читателя...')
                -> required(),
            // Relation::make('reader.group_id')
            //     -> title('Группа студентов')
            //     -> fromModel(Group::class, 'name', 'id')
            //     -> placeholder('Выберите группу студентов...'),
            CheckBox::make('reader.can_get_books')
                -> title('Может получать книги')
                -> placeholder('Выберите, может ли читатель получать книги...')
                -> sendTrueOrFalse(),
        ];
    }
}
