# Всем привет!
А кому привет-то? Данный репозиторий предназначен для реализации библиотечной системы для Библиотечного медиацентра ГАПОУ СО "Нижнетагильский торгово-экономический колледж". Данный проект реализован на [Laravel](https://laravel.com), а также на [Orchid Platform](https://orchid.software).

# А как развернуть?
Развернуть проект можно так. Делаем, значит, *git clone*. Можно его сделать так:
```bash
$ git clone https://github.com/NTCTE/library-assistant-exam.git
```
Но, тут можно столкнуться с проблемой, что у вас не установлен пользователь... и что же делать? А просто нужно ввести две команды в терминал, чтобы донастроить git на компьютере:
```bash
$ git config --global user.name "Your Name"
$ git config --global user.email "your@email.com"
```
# И что дальше?
А дальше, мой дорогой исследователь, необходимо развернуть проект Laravel. Сделать это нужно так:
1. Примонтироваться в папку с проектом `library-assistant-exam`:
	```bash
	$ cd library-assistant-exam
	```
2. Сделать `.env` файл из `.env.example`:
	```bash
	$ cp .env.example .env
	```
3. Теперь надо установить зависимости через Composer:
	```bash
	$ composer require --dev
	```
4. Ну, и последнее, нужно установить ключ безопасности для кук в Laravel:
	```bash
	$ php artisan key:generate
	```
Ну, вроде и все. Проверь, работает ли проект:
```bash
$ php artisan serve
```
# А-а-а, ошибки!
Дружок, наткнулся на ошибку `SQLSTATE[HY000] [2002] Connection refused`? А ты подумай, что не так? Правильно, конечно! А базу данных ты настроил? Нет, конечно. Давай я тебе помогу настроить подключение к SQLite:
1. Создай базу данных в директории `database`:
	```bash
	$ touch ./database/dbase.sqlite
	```
2. Открой файл `.env` в редакторе кода и установи следующие значения в разделе `DB_`:
```properties
DB_CONNECTION=sqlite
DB_DATABASE=/home/YOUR_USERNAME/path/to/project/library-assistant-exam/database/dbase.sqlite
DB_FOREIGN_KEYS=true
```
И попробуй [перейти в проект](http://localhost:8000) ещё раз.

Ну, вот и все. Проект готов к работе. Надо теперь сделать, самое важное --- провести миграцию.

## Ну, и последняя помощь
Для полноценной и успешной разработки, предлагаю следующие плагины для Visual Studio Code:
1. [HTML CSS Support](https://marketplace.visualstudio.com/items?itemName=ecmel.vscode-html-css)
2. [IntelliCode API Usage Examples](https://marketplace.visualstudio.com/items?itemName=VisualStudioExptTeam.intellicode-api-usage-examples)
3. [Laravel Artisan](https://marketplace.visualstudio.com/items?itemName=ryannaddy.laravel-artisan)
4. [Laravel Blade formatter](https://marketplace.visualstudio.com/items?itemName=shufo.vscode-blade-formatter)
5. [Laravel Blade Snippets](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-blade)
6. [Laravel Blade Spacer](https://marketplace.visualstudio.com/items?itemName=austenc.laravel-blade-spacer)
7. [Laravel Blade Wrapper](https://marketplace.visualstudio.com/items?itemName=IHunte.laravel-blade-wrapper)
8. [Laravel Extension Pack](https://marketplace.visualstudio.com/items?itemName=onecentlin.laravel-extension-pack)
9. [Laravel Extra Intellisense](https://marketplace.visualstudio.com/items?itemName=amiralizadeh9480.laravel-extra-intellisense)
10. [Laravel goto view](https://marketplace.visualstudio.com/items?itemName=codingyu.laravel-goto-view)
11. [laravel-goto-components](https://marketplace.visualstudio.com/items?itemName=naoray.laravel-goto-components)
12. [laravel-jump-controller](https://marketplace.visualstudio.com/items?itemName=pgl.laravel-jump-controller)
13. [PHP](https://marketplace.visualstudio.com/items?itemName=DEVSENSE.phptools-vscode)
14. [PHP Debug](https://marketplace.visualstudio.com/items?itemName=xdebug.php-debug)
15. [PHP Extension Pack](https://marketplace.visualstudio.com/items?itemName=xdebug.php-pack)
16. [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)
17. [PHP IntelliSense](https://marketplace.visualstudio.com/items?itemName=zobo.php-intellisense)
18. [PHP Profiler](https://marketplace.visualstudio.com/items?itemName=DEVSENSE.profiler-php-vscode)