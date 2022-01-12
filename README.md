# Product recommendations API

## Content
* [Challenge description](#challenge-description)
* [Technologies](#technologies)
* [Setup](#setup)
* [Examples](#examples)

## Challenge description

The prime aim of the project is an application getting from an external source (https://api.meteo.lt/) current weather information in any Lithuanian city. Aggregates conditions of 3 days and recommends suitable products by the weather forecast.


## Technologies

Project is created with:
- PHP 8.1.1;
- Composer 2.2.3 create laravel project;
- Laravel framework 8.78.1;
- MySQL [database](https://db4free.net/);
- Postman to build, test and modify APIs;
- Heroku host [application](https://productrecommendations.herokuapp.com/api/products/recommended/kaunas).

## Setup

Run `php artisan serve` for a dev server. Navigate to http://127.0.0.1:8000/api/products/recommended/{city}. The app will automatically reload if you change any of the source files.

## Examples

### Request

GET http://127.0.0.1:8000/api/products/recommended/{city}

### Response

```
{
    "links": {
        "weatherForecastDataSource": "https://api.meteo.lt/"
    },
    "city": "kaunas",
    "recommendations": [
        {
            "weatherForecast": "isolated-clouds",
            "date": "2022-01-12",
            "products": [
                {
                    "sku": "UM-3",
                    "name": "Synergistic Leather Hat",
                    "price": "19.70"
                },
                {
                    "sku": "UM-4",
                    "name": "Heavy Duty Iron Hat",
                    "price": "15.70"
                }
            ]
        },
        ...
    ]
}
```
