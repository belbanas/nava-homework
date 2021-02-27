# NAVA Homework

Author: Benkő Dániel

## Image viewer application

An image metadata listing application with the basic CRUD features.

## Technologies

- Backend: CodeIgniter, MySQL.
- Frontend: CodeIgniter, HTML5, CSS, Vanilla JS with AJAX.

## Setup

1. Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.
2. Run `composer install` for installing required dependencies.
3. Setup your database using the 'db_init.sql' and 'db_dump.sql' files in this exact order.

## Running the application

For testing the application just type `php spark serve` and navigate to the address.

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
