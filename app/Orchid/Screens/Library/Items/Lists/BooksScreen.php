<?php

namespace App\Orchid\Screens\Library\Items\Lists;

use App\Models\Library\Items\Book;
use App\Orchid\Layouts\Library\Items\BooksDataRows;
use App\Orchid\Layouts\Library\Items\BooksTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BooksScreen extends Screen
{
        
    /**
     * Books Eloquent entities.
     *
     * @var mixed
     */
    public $books;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'books' => Book::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Экземпляры';
    }

    public function description(): ?string
    {
        return 'На данном экране отображаются все экземпляры книг, которые есть в библиотеке.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить экземпляр')
                -> icon('bs.person-add')
                -> modal('bookMeta')
                -> modalTitle('Добавление экземпляра')
                -> method('createUpdateBook'),
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
            Layout::modal('bookMeta', [
                BooksDataRows::class,
            ])
                -> staticBackdrop()
                -> withoutCloseButton()
                -> async('asyncModalBook'),
            BooksTable::class,
        ];
    }

    public function asyncModalBook(): array
    {
        if (!empty(request() -> input('id')))
        {
            return [
                'book' => Book::findOrFail(request() -> input('id'))
                    -> toArray(),
            ];
        } else return [];
    }

    public function createUpdateBook()
    {
        $book = request() -> input('book');
        if (!empty($book['id']))
        {
            Book::findOrFail($book['id'])
                -> update($book);

            Toast::info('Экземпляр успешно обновлен.');
        } else
        {
            Book::create($book);

            Toast::success('Экземпляр успешно добавлен.');
        }
    }

    public function remove()
    {
        Book::findOrFail(request() -> input('id'))
            -> delete();

        Toast::info('Экземпляр успешно удален.');
    }
}
