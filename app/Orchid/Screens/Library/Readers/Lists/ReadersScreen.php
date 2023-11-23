<?php

namespace App\Orchid\Screens\Library\Readers\Lists;

use App\Models\Library\Readers\Reader;
use App\Orchid\Layouts\Library\Readers\ReaderRows;
use App\Orchid\Layouts\Library\Readers\ReadersTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ReadersScreen extends Screen
{
    /**
     * Readers Eloquent entities.
     *
     * @var mixed
     */
    public $readers;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'readers' => Reader::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Читатели';
    }

    public function description(): ?string
    {
        return 'Данный экран предназначен для просмотра и редактирования списка читателей.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить читателя')
                -> icon('bs.plus-circle')
                -> modal('createUpdateReaderModal')
                -> method('createUpdateReader')
                -> modalTitle('Добавление читателя'),
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
            Layout::modal('createUpdateReaderModal', [
                ReaderRows::class,
            ])
                -> withoutCloseButton()
                -> staticBackdrop()
                -> async('asyncGetReader'),
            ReadersTable::class,
        ];
    }

    public function asyncGetReader(): array
    {
        if (!empty(request() -> input('id')))
        {
            return [
                'reader' => Reader::findOrFail(request() -> input('id'))
                    -> toArray(),
            ];
        } else return [];
    }

    public function createUpdateReader()
    {
        $reader = request() -> input('reader');
        if (!empty($reader['id']))
        {
            Reader::findOrFail($reader['id'])
                -> update($reader);

            Toast::info('Читатель успешно обновлен.');
        } else
        {
            Reader::create($reader);

            Toast::success('Читатель успешно добавлен.');
        }
    }

    public function remove()
    {
        Reader::findOrFail(request() -> input('id'))
            -> delete();

        Toast::info('Читатель успешно удален.');
    }
}
