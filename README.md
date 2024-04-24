
## Prerequisites

Please ensure that you have installed Docker on your machine as this project makes use of Laravel Sail.

## Installation

To set up the project with Laravel Sail, please follow the instructions below:

- `git clone git@github.com:robertkabat/we3-test.git` the repository.
- Navigate to the root directory of the project.
- Copy the `.env.example` file to a new file named `.env` using the command `cp .env.example .env`.

### Settings in `.env`

This task uses standard configuration for Laravel Sail, so please feel free to follow standard laravel configuration.

## Setting up the project

- Run `composer install` to install the project dependencies.
- After composer is done, run `./vendor/bin/sail up -d`.
- After setting up your `.env` file, run `./vendor/bin/sail artisan key:generate` to set your application key.

## Database Setup

- After starting Laravel Sail, run `./vendor/bin/sail artisan migrate --seed` to set up your database tables.
- When testing manually the easiest way is to simply run `./vendor/bin/sail artisan migrate:fresh --seed` to get back to the original state.

## Check

Navigate to localhost in your browser to make sure the project is up and running. If it is, you should be able to see the default Laravel welcome page.

## Creating a User

- For simplicity user is being seeded along with `--seed` option, as this is not a focus of this task (email: `dexter@miami.us`, password: `password`).

That should give you a token that you can use to authenticate yourself with the API, e.g:

```json
{
    "token": "5|Yc2f8rLw1956Mh8tvAUhDtAV4bwpA2YvQ0A73Grze4a84c01"
}
```

## ENPOINTS:

### Product endpoint: `GET /api/v1/products`

### Headers

- `Accept: application/json`
- `Authorization: Bearer 5|Yc2f8rLw1956Mh8tvAUhDtAV4bwpA2YvQ0A73Grze4a84c01` - remember to replace the token with one generated from the API call :)

### Query parameters

- `sku` - filter by SKU
- `name` - filter by name
- `page` - page number
- `perPage` - number of items per page

e.g. `GET /api/v1/products?sku=sku&name=name&page=1&perPage=10`

### Example response

```json
{
    "data": [
        {
            "id": 1,
            "brand_id": 1,
            "sku": "SKU29111417",
            "name": "debitis",
            "price": 73,
            "description": "Odit pariatur officiis ipsa eum voluptatem totam. Consectetur libero autem est placeat. Laborum ut dolor quas et. Sunt consequuntur vitae voluptate ab consectetur molestias.",
            "created_at": "2024-04-24T21:12:32.000000Z",
            "updated_at": "2024-04-24T21:12:32.000000Z"
        }
    ],
    "links": {
        "first": "http://localhost/api/v1/products?page=1",
        "last": "http://localhost/api/v1/products?page=20",
        "prev": null,
        "next": "http://localhost/api/v1/products?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 20,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://localhost/api/v1/products?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=9",
                "label": "9",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=10",
                "label": "10",
                "active": false
            },
            {
                "url": null,
                "label": "...",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=19",
                "label": "19",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=20",
                "label": "20",
                "active": false
            },
            {
                "url": "http://localhost/api/v1/products?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost/api/v1/products",
        "per_page": 1,
        "to": 1,
        "total": 20
    }
}
```


### Product endpoint: `POST /api/v1/login`

### Headers

- `Accept: application/json`

### Body

```json
{
    "email": "dexter@miami.us",
    "password": "password"
}
```

### Example response

```json
{
    "token": "5|Yc2f8rLw1956Mh8tvAUhDtAV4bwpA2YvQ0A73Grze4a84c01"
}
```

## Manual Testing

Best way to test the API is to use Postman or Insomnia, as it allows you to easily set headers and query parameters.

# Feature tests

To run feature tests please navigate to the root directory in the console and run the following command: `./vendor/bin/sail artisan test`
