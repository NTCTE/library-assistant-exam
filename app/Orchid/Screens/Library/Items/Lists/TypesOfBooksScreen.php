<?php

namespace App\Orchid\Screens\Library\Items\Lists;

use App\Models\Library\Items\TypeOfBook;
use App\Orchid\Layouts\Library\Items\TypeOfBooksDataRows;
use App\Orchid\Layouts\Library\Items\TypeOfBooksTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TypesOfBooksScreen extends Screen
{
    /**
     * TypeOfBook Eloquent entities.
     *
     * @var mixed
     */
    public $types_of_books;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'types_of_books' => TypeOfBook::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Типы экземпляров';
    }

    public function description(): ?string
    {
        return 'На данном экране можно управлять типами экземпляров, которые будут отображаться в библиотеке.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить тип экземпляра')
                -> icon('bs.book')
                -> modal('typeOfBookMeta')
                -> modalTitle('Добавление типа экземпляра')
                -> method('createUpdateTypeOfBook'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::modal('typeOfBookMeta', [
                TypeOfBooksDataRows::class,
            ])
                -> title('Добавление типа экземпляра')
                -> applyButton('Добавить')
                -> async('asyncGetTypeOfBook'),
            TypeOfBooksTable::class,
        ];
    }

    public function asyncGetTypeOfBook(): array
    {
        return [
            'type_of_book.id' => !empty(request() -> input('id')) ? request() -> input('id') : '',
            'type_of_book.name' => !empty(request() -> input('name')) ? request() -> input('name') : '',
        ];
    }

    public function createUpdateTypeOfBook()
    {
        $type_of_book = request() -> input('type_of_book');
        if (!empty($type_of_book['id']))
        {
            TypeOfBook::find($type_of_book['id'])
                -> update($type_of_book);
            
            Toast::info('Тип экземпляра успешно обновлен.');
        } else
        {
            TypeOfBook::create($type_of_book);

            Toast::success('Тип экземпляра успешно добавлен.');
        }
    }

    public function remove()
    {
        TypeOfBook::findOrFail(request() -> input('id'))
            -> delete();

        Toast::info('Тип экземпляра успешно удален.');
    }
}
