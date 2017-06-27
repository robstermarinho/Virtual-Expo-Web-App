# Virtual Expo App

This is a project to deliver an application for web that allows companies to book their place in virtual expositions in different exposition events.
Companies can choose from available events the one they want to take place in, then they will choose their stand within the exposition hall from a map.

## Functional Features

  - Integration with Google Maps API to point events on the map based on their street address
  - RESTful API (Back-End)
  - Single Page Application (Front-End)

## Getting Started

### Install components

To install all components needed by application, run the following command in the root directory of your project:

```
composer install
```
Go inside `public/app` and run the following comand:
```
bower install
```

### Environment variables

Create a `.env` file in the root directory of your project. Provide some
environment-specific variables like in `.env.example` file:

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=mailgun
MAILGUN_DOMAIN=
MAILGUN_SECRET=
MAIL_FROM_ADDRESS=no-response@virtualexpo.com
MAIL_FROM_NAME=VirtualExpo

FILESYSTEM_DRIVER=files
```

### Generate a new APP_KEY:

Run the following comand to 

```
php artisan key:generate
```

### Database and Seed

This App provides some migrations and seed for the tables.
Run the following command in the root directory of your project to create the tables on the database and seed them:

```
php artisan migrate --seed
```

The seeding provides pre-configured events, users, companies, stands and bookins. You can logging in the application using the admin user:

| User | Role | Password
| ------ | ------ | ------ |
| admin@admin.com | admin | secret |

The simplest way to start a server is:

```
php artisan serve
```

Verify the deployment by navigating to your server address in your preferred browser.

```
127.0.0.1:8000
```

## Development Environment 

* Back-end

    - System: Mac OS Sierra `10.12.5`
    - Web Server: [Apache](http://apach.org) `2.0`
    - Text Editor: [Sublime](https://www.sublimetext.com/) `3`
    - Language: [PHP](http://php.net) `7.1.1`
    - Database: [MySQL](http://mysql.com) `5.6.35`
    - Dependency package manager for PHP: [Composer](http://getcomposer.org) `1.2.0` 
    - PHP Framework: [Laravel](http://laravel.com) `5.4`
    - Version Control System: [Git](http://git-scm.com) `2.9.2` 
    
* Front-end

    - HTML/JavaScript/CSS    
    - JS Framework: [AngularJS](http://angularjs.org) `1.6.4`
    - CSS: [Bootstrap](http://getbootstrap.com) `3.3.7`


## License

The app is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

