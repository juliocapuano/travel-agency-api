# Travel Agency API

Laravel APIs application for a travel agency.

## Installation

Clone the repository:

```bash
git clone https://github.com/juliocapuano/travel-agency-api.git
```

Change into the project directory:

```bash
cd travel-agency-api
```

Install the dependencies:

```bash
composer install
```

Create a copy of the .env.example file and rename it to .env:

```bash
cp .env.example .env
```

Generate an application key:

```bash
php artisan key:generate
```

Configure the .env file with your database credentials and other settings.

Run the database migrations:

```bash
php artisan migrate
```

Seed the database:

```bash
# required
php artisan db:seed

# optional | demo data  
php artisan db:seed DemoDataSeeder
```

Start the development server:

```bash
php artisan serve
```

## API Reference

Under construction

[//]: # (#### Get all items)

[//]: # ()

[//]: # (```http)

[//]: # (  GET /api/items)

[//]: # (```)

[//]: # ()

[//]: # (| Parameter | Type     | Description                |)

[//]: # (|:----------|:---------|:---------------------------|)

[//]: # (| `api_key` | `string` | **Required**. Your API key |)

[//]: # ()

[//]: # (#### Get item)

[//]: # ()

[//]: # (```http)

[//]: # (  GET /api/items/${id})

[//]: # (```)

[//]: # ()

[//]: # (| Parameter | Type     | Description                       |)

[//]: # (|:----------|:---------|:----------------------------------|)

[//]: # (| `id`      | `string` | **Required**. Id of item to fetch |)

[//]: # ()

[//]: # (#### add&#40;num1, num2&#41;)

[//]: # ()

[//]: # (Takes two numbers and returns the sum.)

## Glossary

Travel is the main unit of the project: it contains all the necessary information, like the number of days, the images,
title, etc. An example is Japan: road to Wonder or Norway: the land of the ICE;
Tour is a specific dates-range of a travel with its own price and details. Japan: road to Wonder may have a tour from 10
to 27 May at €1899, another one from 10 to 15 September at €669 etc. At the end, you will book a tour, not a travel.

## Goals

At the end, the project should have:

- [x] A private (admin) endpoint to create new users. If you want, this could also be an artisan command, as you like.
  It will mainly be used to generate users for this exercise;
- [x] A private (admin) endpoint to create new travels;
- [x] A private (admin) endpoint to create new tours for travel;
- [x] A private (editor) endpoint to update a travel;
- [ ] A public (no auth) endpoint to get a list of paginated travels. It must return only public travels;
- [ ] A public (no auth) endpoint to get a list of paginated tours by the travel slug (e.g. all the tours of the travel
  foo-bar). Users can filter (search) the results by priceFrom, priceTo, dateFrom (from that startingDate) and dateTo (
  until that startingDate). User can sort the list by price asc and desc. They will always be sorted, after every
  additional user-provided filter, by startingDate asc.

## Plan of Actions

- Check Database Structure
    - [x] Models
    - [x] Migrations
    - [x] Factories
    - [x] Seeders
- Model Operations
    - [x] Router
    - [x] CRUD
- Auth Security
    - [x] Login
    - [x] Role related

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
