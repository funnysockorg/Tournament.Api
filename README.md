# Tournament.Api

## Установка

* Установить PHP 8.2 версии и выше
* Создать `.env`

  ```bash
  cp .env.example .env
  ```

* создать приложение в Discord'e по ссылке <https://discord.com/developers/applications>
* перейти на вкладку OAuth2
* переписать оттуда в `.env` следующие поля:

  ```bash
  DISCORD_CLIENT_ID=$YOUR_CLIENT_ID
  DISCORD_SECRET_KEY=$YOUR_SECRET_KEY
  ```

* назначить во вкладке `Redirects`:

  ```bash
  $HOST/api/discord/callback
  ```

  где `$HOST` заменить на свой хост с сервером.

  К примеру, для разработки получится такая строка: `http://localhost:8000/api/discord/callback`.
* заполнить `DISCORD_REDIRECT_URL` в `.env`

  После авторизации через Discord, сервер редиректит по этой ссылке обратно на клиент, если всё прошло хорошо, вместе с сессионными куками.
* Сгенерировать `APP_KEY` в `.env`:

  ```bash
  php artisan key:generate
  ```

* устноавить нужные пакеты через Composer:

  ```bash
  composer install
  ```

  Установить `composer` можно по [этой ссылке](https://getcomposer.org/download/).
* создать SQLite базу данных:

  ```bash
  php artisan migrate
  ```

* запустить

  ```bash
  php artisan serve --host 0.0.0.0 --port 8000
  ```

Сгенерировать ссылку-приглашение:

* В "OAuth2 URL Generator" (<https://discord.com/developers/applications/$YOUR_CLIENT_ID/oauth2>) отметить пункт "identify"
* выбрать первое из выпадающего меню "Select redirect URL"
* сохранить ссылку для проверки

Через нее клиент будет авторизовываться и можно проверить работоспособность авторизации.
