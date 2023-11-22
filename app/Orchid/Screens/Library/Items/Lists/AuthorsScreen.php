<?php

namespace App\Orchid\Screens\Library\Items\Lists;

use App\Models\Library\Items\Author;
use App\Orchid\Layouts\Library\Items\AuthorDataRows;
use App\Orchid\Layouts\Library\Items\AuthorsTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class AuthorsScreen extends Screen
{    
    /**
     * Authors Eloquent entities.
     *
     * @var mixed
     */
    public $authors;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'authors' => Author::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Авторы';
    }

    public function description(): ?string
    {
        return 'На данном экране можно управлять авторами, которые будут отображаться в библиотеке.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить автора')
                -> icon('bs.person-add')
                -> modal('authorMeta')
                -> modalTitle('Добавление автора')
                -> method('createUpdateAuthor'),
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
            Layout::modal('authorMeta', AuthorDataRows::class)
                -> staticBackdrop()
                -> withoutCloseButton()
                -> async('asyncModalAuthor'),
            AuthorsTable::class,
        ];
    }

    public function asyncModalAuthor()
    {
        $author = [
            'id' => request() -> input('id'),
            'lastname' => request() -> input('lastname'),
            'firstname' => request() -> input('firstname'),
            'patronymic' => request() -> input('patronymic'),
        ];
        return [
            'author.id' => !empty($author['id']) ? $author['id'] : '',
            'author.lastname' => !empty($author['lastname']) ? $author['lastname'] : '',
            'author.firstname' => !empty($author['firstname']) ? $author['firstname'] : '',
            'author.patronymic' => !empty($author['patronymic']) ? $author['patronymic'] : '',
        ];
    }

    public function createUpdateAuthor()
    {
        $author = request() -> input('author');
        if (!empty($author['id']))
        {
            Author::findOrFail($author['id']) -> update($author);
            
            Toast::info('Автор успешно обновлен.');
        } else
        {
            (new Author())
                -> fill($author)
                -> save();

            Toast::success('Автор успешно добавлен.');
        }
    }

    public function remove()
    {
        $id = request() -> input('id');
        Author::findOrFail($id) -> delete();

        Toast::info('Автор успешно удален.');
    }
}
