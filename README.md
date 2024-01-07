# Kayne Request App

Welcome to the Kayne request application. This application exposes an API that returns Kayne West quotes from the API "Kayne Rest".

## Documentation

To get started clone the github repo using the below command:

``` bash
git clone https://github.com/jsandfordhughes/kanye-request.git
```

Once downloaded, cd into the folder and run composer

``` bash
composer install
```

Now you need to copy the .env.example file to .env.

You are now ready to use the application. To start a local webserver run

``` bash
php artisan serve
```

The feedback in the terminal will tell you what address and port the server is running on, you can now use a browser or an application like [Postman](https://www.postman.com/) to retrieve the quotes. 

The application uses simple authentication in the way of an API key. Your request should append an api_key in the query string, the API keys can be found in the file `config/api_authentication.php`

``` bash
/api/quotes?api_key=APIKEYHERE
```

This application exposes 2 endpoints:

```
GET /api/quotes
```
```
GET /api/quotes/refresh
```

The first endpoint retrieves 5 of the quotes and returns them in an array which is cached for 5 minutes. The second endpoint refreshes the cache and returns new quotes.

## Testing

To run the tests

``` bash
php artisan test
```

