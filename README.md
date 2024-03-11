# Book Management

This Project is supposed for submission Home Test Software Engineer 2024 at Azura Lab. 

## ENV
You can use the basic env that laravel gives to you just change the database name and maybe the smtp provider, I use mailtrap for testing purpose.

## Run Locally

Clone the project

```bash
  git clone https://github.com/attaf-riski/azuralabssubmission.git
```

Go to the project directory

```bash
  cd azuralabssubmission
```

Create Database on MySQL With name atafbookmanagement
```bash
CREATE DATABASE atafbookmanagement;
```
Install dependencies

```bash
  composer install
```

Make .env file
## optional, if you want to use forget password feature
## Make sure you change the Mailtrap credential
```text
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:1ps61jfAf7xq8u3FELD7sJ1zmYZOKUwtmiTk6A66HOM=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=atafbookmanagement
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=<change>
MAIL_PASSWORD=<change>
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

Run Migration

```bash
php artisan migrate
```

Start the server

```bash
  php artisan serve
```

The app is ready to use, have fun!

