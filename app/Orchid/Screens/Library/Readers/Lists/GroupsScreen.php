<?php

namespace App\Orchid\Screens\Library\Readers\Lists;

use App\Models\Library\Readers\Group;
use App\Orchid\Layouts\Library\Groups\GroupRows;
use App\Orchid\Layouts\Library\Groups\GroupsTable;
use App\Orchid\Layouts\Library\Readers\ReaderRows;
use App\Orchid\Layouts\Library\Readers\ReadersTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class GroupsScreen extends Screen
{    
    /**
     * Groups Eloquent entities.
     *
     * @var mixed
     */
    public $groups;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'groups' => Group::paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Группы студентов';
    }

    public function description(): ?string
    {
        return 'Данный экран предназначен для просмотра и редактирования списка групп студентов.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Добавить группу')
                -> icon('bs.plus-circle')
                -> modal('createUpdateGroupModal')
                -> method('createUpdateGroup')
                -> modalTitle('Добавление группы студентов')
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
            Layout::modal('createUpdateGroupModal', [
                GroupRows::class,
            ])
                -> withoutCloseButton()
                -> staticBackdrop()
                -> async('asyncGetGroup'),
            GroupsTable::class,
        ];
    }

    public function asyncGetGroup(): array
    {
        if (!empty(request() -> input('id')))
        {
            return [
                'group' => Group::findOrFail(request() -> input('id'))
                    -> toArray(),
            ];
        } else return [];
    }

    public function createUpdateGroup()
    {
        $group = request() -> input('group');
        if (!empty($group['id']))
        {
            Group::findOrFail($group['id'])
                -> update($group);

            Toast::info('Группа студентов успешно обновлена.');
        } else
        {
            Group::create($group);

            Toast::success('Группа студентов успешно добавлена.');
        }
    }

    public function remove()
    {
        Group::findOrFail(request() -> input('id'))
            -> delete();

        Toast::info('Группа студентов успешно удалена.');
    }
}
