<?php

declare(strict_types=1);

use App\Orchid\Screens\Library\Items\Lists\AuthorsScreen;
use App\Orchid\Screens\Library\Items\Lists\BooksScreen;
use App\Orchid\Screens\Library\Items\Lists\TypesOfBooksScreen;
use App\Orchid\Screens\Library\Readers\Lists\GroupsScreen;
use App\Orchid\Screens\Library\Readers\Lists\ReadersScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Platform > Library > Authors
Route::screen('items/authors', AuthorsScreen::class)
    -> name('items.authors')
    -> breadcrumbs(fn (Trail $trail) => $trail
        -> parent('platform.index')
        -> push('Авторы', route('items.authors')));

// Platform > Library > Books
Route::screen('items/books', BooksScreen::class)
    -> name('items.books')
    -> breadcrumbs(fn (Trail $trail) => $trail
        -> parent('platform.index')
        -> push('Издания', route('items.books')));

// Platform > Library > Publishings
Route::screen('items/publishings', BooksScreen::class)
    -> name('items.publishings')
    -> breadcrumbs(fn (Trail $trail) => $trail
        -> parent('platform.index')
        -> push('Издатели', route('items.publishings')));

// Platform > Library > Types of books
Route::screen('items/types-of-books', TypesOfBooksScreen::class)
    -> name('items.types-of-books')
    -> breadcrumbs(fn (Trail $trail) => $trail
        -> parent('platform.index')
        -> push('Типы изданий', route('items.types-of-books')));

// Platform > Library > Groups
Route::screen('readers/groups', GroupsScreen::class)
    -> name('readers.groups')
    -> breadcrumbs(fn (Trail $trail) => $trail
        -> parent('platform.index')
        -> push('Группы читателей', route('readers.groups')));

// Platform > Library > Readers
Route::screen('readers/readers', ReadersScreen::class)
    -> name('readers.readers')
    -> breadcrumbs(fn (Trail $trail) => $trail
        -> parent('platform.index')
        -> push('Читатели', route('readers.readers')));