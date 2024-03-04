# Shopee Crawler
 A website demonstrate product crawled from Shopee

## **Description**
With 4 given criteria, this website is completed with these features: listing products with search, sort, pagination, manage cart, login, register.

## **Deployment**
Follow these steps to setting up the project
1. Pull source code from repository
   
2. Start XAMPP for MySQL on port 3306
   
3. Install composer
   ```console
   composer install
   ```
   
4. Copy .env file from .env.example

5. Run migrate in terminal
   ```console
   php artisan migrate
   ```
6. Run seeder to insert products into Database
   ```console
   php artisan db:seed
   ```
7. Generate app key
   ```console
   php artisan key:generate
   ```
8. Start project
   ```console
   php artisan serve
   ```
Website is online! Let's [browse](http://localhost:8000/)!
## **Additional information**
I tried to use [Guzzle](https://docs.guzzlephp.org/en/stable/) - comes along with Laravel - to access Shopee data but it seems like Shopee changed their behavior to block non-browser requests. Due to that reason, I decided to work around the lack of data problem of my website by using [Laravel Seeder](https://laravel.com/docs/10.x/seeding) to generate fake products.
