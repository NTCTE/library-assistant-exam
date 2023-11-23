<?php

namespace App\Orchid\Screens\Library\Items\Lists;

use App\Models\Library\Items\Publishing;
use App\Orchid\Layouts\Library\Items\PublishingDataRows;
use App\Orchid\Layouts\Library\Items\PublishingsTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PublishingsScreen extends Screen
{
    /**
     * Publishings Eloquent entities.
     *
     * @var mixed
     */
    public $publishings;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'publishings' => Publishing::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Издательства';
    }

    public function description(): ?string
    {
        return 'На данном экране можно управлять издательствами, которые будут отображаться в библиотеке.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить издательство')
                -> icon('bs.building')
                -> modal('publishingMeta')
                -> modalTitle('Добавление издательства')
                -> method('createUpdatePublishing'),
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
            Layout::modal('publishingMeta', [
                PublishingDataRows::class,
            ])
                -> staticBackdrop()
                -> withoutCloseButton()
                -> async('asyncModalPublishing'),
            PublishingsTable::class,
        ];
    }

    public function asyncModalPublishing(): array
    {
        $publishing = [
            'name' => request() -> input('name'),
            'id' => request() -> input('id'),
        ];
        return [
            'publishing.id' => !empty($publishing['id']) ? $publishing['id'] : '',
            'publishing.name' => !empty($publishing['name']) ? $publishing['name'] : '',
        ];
    }

    public function createUpdatePublishing()
    {
        $publishing = request() -> input('publishing');
        if (!empty($publishing['id']))
        {
            Publishing::findOrFail($publishing['id'])
                -> update($publishing);

            Toast::info('Издательство успешно обновлено.');
        } else
        {
            Publishing::create($publishing);

            Toast::success('Издательство успешно добавлено.');
        }
    }

    public function remove()
    {
        $id = request() -> input('id');
        Publishing::findOrFail($id) -> delete();

        Toast::info('Издательство успешно удалено.');
    }
}
