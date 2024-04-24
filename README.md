
## Prerequisites

Please ensure that you have installed Docker on your machine as this project makes use of Laravel Sail.

## Installation

To set up the project with Laravel Sail, please follow the instructions below:

- `git clone git@github.com:robertkabat/mkm-test.git` the repository.
- Navigate to the root directory of the project.
- Copy the `.env.example` file to a new file named `.env` using the command `cp .env.example .env`.

For ease of use, the `.env` file has been pre-configured with my local environment settings. Please adjust as needed.

### Database Settings in `.env`

All the values are provided in the .env.example file. Please adjust as needed.

If you run into any database issues, please make sure that the database exists and that all the information in your
final version of the `.env` file is correct.

- Run `composer install` to install the project dependencies.
- After composer is done, run `./vendor/bin/sail up -d`.
- After setting up your `.env` file, run `./vendor/bin/sail artisan key:generate` to set your application key.

## Database Setup

- After starting Laravel Sail, run `./vendor/bin/sail artisan migrate --seed` to set up your database tables.
- When testing manually the easiest way is to simply run `./vendor/bin/sail artisan migrate:fresh --seed` to get back to the original state.

## Check

Navigate to localhost in your browser to make sure the project is up and running. If it is, you should be able to see the default Laravel welcome page.

## Creating a User

- For simplicity user is being seeded along with `--seed` option, as this is not a focus of this task.

## API

Login endpoint: `POST /api/login`, this endpoint takes following body:

```json
{
    "email": "rob@mkm.com",
    "password": "password"
}
```

That should give you a token that you can use to authenticate yourself with the API, e.g:

```json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTcxMzgxNDMwNywiZXhwIjoxNzEzODE3OTA3LCJuYmYiOjE3MTM4MTQzMDcsImp0aSI6Inh6ZXpXeTdvU2lTaGJWZTAiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.gv9bD5dOcr2-YiU4Jx59CWWjafoImY4-V1rJ1HQqn2w",
    "token_type": "bearer",
    "expires_in": 3600
}
```

Headers:

- `Accept: application/json`
- `Authorization: Bearer sLdnoDvLjJZ1lRO3b08DLWcu82zHtxgQeDOlV604NGrpYW2005kwdeVgISxw` - remember to replace the token with one generated from the API call :)

Product endpoint: `GET /api/products/{SKU}`, it will need the headers mentioned before.

## Manual Testing

You can use details from the `API` section of this readme file to make an API call via, say, Postman.

# Feature tests

To run feature tests please navigate to the root directory in the console and run the following command: `./vendor/bin/sail artisan test`
