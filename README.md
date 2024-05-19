# Tournament.Api

## Deploy on Replit

* Создать на Replit пустой проект "Blank Repl"
* Склонировать проект

  ```bash
  rm -rf * .* && git clone https://github.com/funnysockorg/Tournament.Api.git .
  ```

* Установить пакеты:

  ```bash
  composer install
  ```

* Создать `.env`:

  ```bash
  cp .env.example .env
  ```

* Сгенерировать `APP_KEY`:

  ```bash
  php artisan key:generate --ansi
  ```

* Открыть у себя на компе `.env.json`
* Переписать из `.env` значение `APP_KEY` в `.env.json`

  `.env` прочитать через `cat`, потому что Replit его скрывает.
* Заполнить `APP_URL`

  Узнать текущий Dev URL можно так:

  ```bash
  echo $REPLIT_DEV_DOMAIN
  ```

  Либо через панель "Networking", которую можно вызвать так:

  * нажать `ctrl + p` в открытом Replit и нажать `backspace`
  * ввести `networking`
  * нажать `enter`
  * в открывшейся панели и будет `Dev URL:`

* Заполнить нужные поля:

  ```json
  "DISCORD_CLIENT_ID": "$YOUR_CLIENT_ID"
  "DISCORD_SECRET_KEY": "$YOUR_SECRET_KEY"
  ```

* Скопировать содержимое `.env.json` в буфер обмена
* Открыть в Replit панель "Secrets"
* Нажать на "Edit as JSON"
* В открывшееся окно вставить содержимое буфера
* Смело удалить пустые `CACHE_PREFIX`, `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_BUCKET`, которые Replit зачем-то добавляет
* Перезапустить Replit:

  ```bash
  kill 1
  ```

* Создать БД:

  ```bash
  php artisan migrate
  ```
