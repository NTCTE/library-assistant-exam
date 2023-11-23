<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Авторы')
                -> icon('bs.people')
                -> title('Категоризация')
                -> route('items.authors'),

            Menu::make('Издательства')
                -> icon('bs.building')
                -> route('items.publishings'),

            Menu::make('Типы экземпляров')
                -> icon('bs.book')
                -> route('items.types-of-books'),

            Menu::make('Экземпляры')
                -> icon('bs.book-half')
                -> title('Инвентаризация')
                -> route('items.books'),

            Menu::make('Читатели')
                -> icon('bs.person-lines-fill')
                -> route('readers.readers'),

            Menu::make('Группы')
                -> icon('bs.people-fill')
                -> route('readers.groups'),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
