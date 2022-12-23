<!-- # Laravel Pharmacy App

# Description:
> Build a system using Laravel framework for a mini Pharmacy where any user  can add pharmacies and products to them, and also he can add price and quantity of every Product in every pharmacy.

# Build Database: 
 1. pharmacies (name & address):
 2. Products: [title,description,image]
 3. ProductPharmacy: [product_id,pharmacy_id,quantity,price]
  >Notes:
   1. product_id is the id of product.(F.K).
   2. pharmacy_id is the id of pharmacy (F.K).
   3. Price is the product price in specific pharmacy refered by pharmacy_id.
   3. quantity is the product quantity in this pharmacy :)

# start work:
 1. make Models, Migration & relations between tables plus laravel UI.
 2. `composer require laravel/ui`.
 3. make CRUD For Product and Pharmacy plus addPrice and quantity for for every product in every pharmacy, Extra search on product in product dashboard page :) and rendering products like :).
 4. make command Line for search and get The Five cheapest prices for product given and the pharmacies details `php artisan products:search-cheapest 2`.
 5. Make Pharmacy Api with Resources for rendering json data `http://127.0.0.1:8000/api/v1/pharmacies` and for products `http://127.0.0.1:8000/api/v1/products`
 6. and Search product query by title or address `127.0.0.1:8000/api/v1/products?title[eq]=ddd&description[like]=kkdkkd`
 6. make Factories and seeders for create 50K products and 20K pharmacies and their relation :) for testing :) `php artisan  migrate:fresh seed`.
 7. Complete All Coding Until Finish :)


# Steps To Run This Pharmacy:
  To clone the project you must follow the following steps:
  1. Navigate to the main page of the repository.
  2. Above the list of files, click Code button and copy the https link.
  3. Go to your visual studio code editor then open the terminal and write this command git clone with https linK.
  4. Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu.
  5. Open your .env file and change the database name to `pharmacydb`, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
  6. open Mysql Host and create Database with `pharmacydb` with your above configuration.
  6. Run `composer install`
  6. Run `php artisan key:generate`
  7. Run `php artisan migrate`
  8. Run `php artisan db:seed` if you want to make atest on some faker data :)
  9. Run `php artisan serve` and start Manage products & pharmacies in Pharmacy App :)  -->
