## Laravel Ecommerce API 
###  - Simple Laravel API to ecommerc  project 
###  - Version 1.0.0

### How can i install it ?
#### 1 - Clone Repositry 
    https://github.com/kassem-hussein/Laravel-ecommerce-api.git
#### 2 - Composer install to intall dependencies 
    composer install
#### 3 - Setup Your database connection using copy of env.example to .env and change connection setup 

#### 4 -  run database migrations 
    php artisan migrate
### 5 - run server 
    php artisan serve

### Feutues of this API
### PRODUCTS RESTFULL
    RESTFULL API  - (USER CAN ACCESS ONLY GET METHOD) 
    GET : /products  -> get All product 
    POST: /Products -> add Product
    PUT : /products/1 ->get product id= 1
    DELETE : /products/1 -> delete product 
### PRODUCT IMAGES
    Apply to upload mulitple image for single product (USER CAN ACCESS ONLY GET METHOD) 

    GET: products/1/images -> get Product Images
    POST: products/1/images ->add Product Image
### Proudct Stock

    Apply user to add mulitple stock for single prodoct based on color and size 
    (USER CAN ACCESS ONLY GET METHOD) 

    GET : /products/1/stocks -> get product stock where product id  = 1
    POST : / products/1/stocks 
    add product stock where product id = 1
### colors (Only admin)
    GET: /colors -> get All colors
    POST: /colors -> add color
    PUT : /colors/1 -> update color where id =1
    DELETE: /colors/1 -> delete color where id = 1
### Sizes (Only Admin)
    GET: /sizes ->get All sizes 
    POST: /sizes -> add size 
    PUT: /sizes/1 -> update size where id = 1
    DELETE: /sizes/1 -> delete size where id = 1
### brands 
    GET : /brands ->get all brands
    POST: /brands ->add new brand (only admin) 
    PUT:  /brands/1-> update brand where id = 1 (only admin)
    DELETE: /brands/1 -> delete brand where id = 1 (admin only)
### categories 
    GET : /categories ->get all categories
    POST: /categories ->add new category (only admin) 
    PUT:  /categories/1-> update category where id = 1 (only admin)
    DELETE: /categories/1 -> delete category where id = 1 (admin only)
### Orders 
    GET : /orders ->get All product (only admin)
    GET : /orders/user -> get all user orders
    POST : /ordrs -> add Order
    PUT : /orders/1 -> update order status where id = 1 (only admin)
    DELETE: /orders/1 delete order  where id = 1 (only admin)
    POST : orders/1/checkout -> checkout for order where id =1
### Authentication (Sanctum Tokens)
    POST : /register 
    POST : /login -> get api token
    GET  : /user-profile -> get user profile

### Users (Only for admin)
    GET : /users -> get all users
    POST: /users -> add new user
    GET:/users/1 -> get user where id = 1
    DELETE: /users/1-> delete user where id = 1
### User Addresses 
    GET : /addresses -> get all addresses (only for admin)
    GET : /addresses/user get all user addresses 
    POST: /addresses -> add address
    PUT : /addresses/1 ->  update adderss where id = 1
    DELETE: /addresses/1 -> delete address where id = 1 
