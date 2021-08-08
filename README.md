
# Rightmove web crawler

## Installation

### Prerequisites

* To run this project, you must have PHP 7.3 installed.
* You should setup a host on your web server for your local domain. For this you could also configure Valet.

### Step 1

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.

```bash
git clone git@github.com:najibu/rightmove_web_crawler.git
cd rightmove_web_crawler && composer install
php artisan serve
```

### Step 2
Next, boot up a server and visit your localhost. If using a tool like Laravel Valet, of course the URL will default to `http://rightmove_web_crawler.test`.

### Testing
```bash
php artisan test
```
