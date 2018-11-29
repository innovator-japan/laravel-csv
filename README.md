# Laravel CSV
[![CircleCI](https://circleci.com/gh/innovator-japan/laravel-csv/tree/master.svg?style=svg)](https://circleci.com/gh/innovator-japan/laravel-csv/tree/master)
[![Coverage Status](https://coveralls.io/repos/github/innovator-japan/laravel-csv/badge.svg?branch=master)](https://coveralls.io/github/innovator-japan/laravel-csv?branch=master)
[![License](https://poser.pugx.org/innovator-japan/laravel-csv/license)](https://packagist.org/packages/innovator-japan/laravel-csv)

## Features
- Easily export to csv from collection
- Highly memory efficient
- Wrapper around [League\Csv](https://github.com/thephpleague/csv)

## Requirements
- **PHP 7.0.10** or later
- **Laravel 5.5** or later
- mbstring extension

## Installation
This project using composer.
```
$ composer require innovator-japan/laravel-csv
```

## Usage
### Exporting a database table as a CSV
1️⃣ First of all, Create this class.
```php
<?php

namespace App\Export;

use App\User;
use Illuminate\Database\Query\Builder;
use InnovatorJapan\LaravelCsv\AbstractCsv;
use InnovatorJapan\LaravelCsv\Exportable;

class UserCsv extends AbstractCsv
{
    use Exportable;

    public function query(): Builder
    {
        return User::latest()->getQuery();
    }
}
```

2️⃣ Then you will be able to download it.
```php
use App\Export\UserCsv;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function export()
    {
        return (new UserCsv())->download('user.csv');
    }
}
```

### Importing CSV records into a database table
Comming soon...

## Maintainers
[Innovator Japan Inc.](https://github.com/innovator-japan)

## Contributing
Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## License
[MIT](LICENSE) © Innovator Japan Inc.
