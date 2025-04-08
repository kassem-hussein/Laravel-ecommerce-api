## E-commerce API

# Project Overview

This project is a comprehensive API-driven management system designed with security, modularity, and scalability in mind. The system provides a rich set of endpoints that are organized by functionality and guarded by role-based middleware, ensuring that sensitive operations are restricted to authorized users.

Key functional areas include:

- **Authentication:**  
  Secure user registration, login, and retrieval of authenticated user details using token-based authentication.

- **Resource Management:**  
  - **Colors, Categories, and Brands:** Manage visual and organizational attributes, with public endpoints for viewing and protected endpoints for modifications.
  - **Sizes:** Full CRUD operations for product sizes, available exclusively to administrative users.
  - **Orders and Products:** Comprehensive endpoints for creating and managing orders and products, including specialized actions like checkout, inventory control, and image management.
  - **Addresses:** Allow authenticated users to manage their own addresses, while administrators have full control over all address records.
  - **Users:** An administrative module to create, list, and manage user profiles.

The project leverages middleware such as `auth:sanctum` for secure authentication and `AdminMiddleware` for administrative actions, ensuring that API access is both secure and appropriately segmented. Overall, the system is built to streamline operations across various modules, making it ideal for applications that require robust management of multiple resource types.

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


# API Documentation

This documentation describes the routes available in the application. Each route is grouped by functionality, including user authentication, colors, categories, brands, sizes, orders, products, addresses, and users.

---

## **Authentication Routes**
| Method | Endpoint      | Middleware         | Description            |
|--------|---------------|--------------------|------------------------|
| GET    | `/user`       | `auth:sanctum`    | Retrieve the authenticated user's details. |
| POST   | `/login`      | None              | Login a user.          |
| POST   | `/register`   | None              | Register a new user.   |

---

## **Colors Routes**
| Method   | Endpoint           | Middleware              | Description              |
|----------|--------------------|-------------------------|--------------------------|
| GET      | `/colors`          | `AdminMiddleware`       | List all colors.         |
| POST     | `/colors`          | `AdminMiddleware`       | Create a new color.      |
| GET      | `/colors/{id}`     | `AdminMiddleware`       | Get color details by ID. |
| PUT      | `/colors/{id}`     | `AdminMiddleware`       | Update color details by ID. |
| DELETE   | `/colors/{id}`     | `AdminMiddleware`       | Delete a color by ID.    |

---

## **Categories Routes**
| Method   | Endpoint           | Middleware              | Description              |
|----------|--------------------|-------------------------|--------------------------|
| GET      | `/categories`      | None                   | List all categories.     |
| GET      | `/categories/{id}` | None                   | Get category details by ID. |
| POST     | `/categories`      | `AdminMiddleware`       | Create a new category.   |
| PUT      | `/categories/{id}` | `AdminMiddleware`       | Update category details by ID. |
| DELETE   | `/categories/{id}` | `AdminMiddleware`       | Delete a category by ID. |

---

## **Brands Routes**
| Method   | Endpoint           | Middleware              | Description              |
|----------|--------------------|-------------------------|--------------------------|
| GET      | `/brands`          | None                   | List all brands.         |
| GET      | `/brands/{id}`     | None                   | Get brand details by ID. |
| POST     | `/brands`          | `AdminMiddleware`       | Create a new brand.      |
| PUT      | `/brands/{id}`     | `AdminMiddleware`       | Update brand details by ID. |
| DELETE   | `/brands/{id}`     | `AdminMiddleware`       | Delete a brand by ID.    |

---

## **Sizes Routes**
| Method   | Endpoint           | Middleware              | Description              |
|----------|--------------------|-------------------------|--------------------------|
| GET      | `/sizes`           | `AdminMiddleware`       | List all sizes.          |
| POST     | `/sizes`           | `AdminMiddleware`       | Create a new size.       |
| GET      | `/sizes/{id}`      | `AdminMiddleware`       | Get size details by ID.  |
| PUT      | `/sizes/{id}`      | `AdminMiddleware`       | Update size details by ID. |
| DELETE   | `/sizes/{id}`      | `AdminMiddleware`       | Delete a size by ID.     |

---

## **Orders Routes**
| Method   | Endpoint                 | Middleware              | Description              |
|----------|--------------------------|-------------------------|--------------------------|
| POST     | `/orders`                | None                   | Create a new order.      |
| GET      | `/orders/user`           | None                   | Get orders of the authenticated user. |
| POST     | `/orders/{id}/checkout`  | None                   | Checkout an order by ID. |
| GET      | `/orders`                | `AdminMiddleware`       | List all orders.         |
| GET      | `/orders/{id}`           | `AdminMiddleware`       | Get order details by ID. |
| PUT      | `/orders/{id}`           | `AdminMiddleware`       | Update order status by ID. |
| DELETE   | `/orders/{id}`           | `AdminMiddleware`       | Delete an order by ID.   |

---

## **Products Routes**
| Method   | Endpoint                 | Middleware               | Description                   |
|----------|--------------------------|--------------------------|-------------------------------|
| GET      | `/products`              | `OnlyGetMethodMiddleware` | List all products.            |
| POST     | `/products`              | `OnlyGetMethodMiddleware` | Create a new product.         |
| DELETE   | `/products/stocks/{id}`  | `OnlyGetMethodMiddleware` | Remove a product stock.       |
| GET      | `/products/{id}`         | `OnlyGetMethodMiddleware` | Get product details by ID.    |
| GET      | `/products/{id}/images`  | `OnlyGetMethodMiddleware` | Get product images.           |
| POST     | `/products/{id}/images`  | `OnlyGetMethodMiddleware` | Add an image to a product.    |
| GET      | `/products/{id}/stocks`  | `OnlyGetMethodMiddleware` | Get product stocks.           |
| POST     | `/products/{id}/stocks`  | `OnlyGetMethodMiddleware` | Add a product stock.          |
| PUT      | `/products/{id}`         | `OnlyGetMethodMiddleware` | Update product details by ID. |
| DELETE   | `/products/{id}`         | `OnlyGetMethodMiddleware` | Delete a product by ID.       |

---

## **Addresses Routes**
| Method   | Endpoint           | Middleware              | Description              |
|----------|--------------------|-------------------------|--------------------------|
| GET      | `/addresses/user`  | None                   | Get addresses of the authenticated user. |
| GET      | `/addresses`       | `AdminMiddleware`       | List all addresses.      |
| POST     | `/addresses`       | `AdminMiddleware`       | Create a new address.    |
| GET      | `/addresses/{id}`  | `AdminMiddleware`       | Get address details by ID. |
| PUT      | `/addresses/{id}`  | `AdminMiddleware`       | Update address details by ID. |
| DELETE   | `/addresses/{id}`  | `AdminMiddleware`       | Delete an address by ID. |

---

## **Users Routes**
| Method   | Endpoint           | Middleware              | Description              |
|----------|--------------------|-------------------------|--------------------------|
| GET      | `/users`           | `AdminMiddleware`       | List all users.          |
| POST     | `/users`           | `AdminMiddleware`       | Create a new user.       |
| GET      | `/users/{id}`      | `AdminMiddleware`       | Get user details by ID.  |
| DELETE   | `/users/{id}`      | `AdminMiddleware`       | Delete a user by ID.     |

---

## **Additional Routes**
| Method   | Endpoint          | Middleware         | Description                |
|----------|-------------------|--------------------|----------------------------|
| GET      | `/user-profile`   | None              | Retrieve user profile details. |

---

## Notes
1. Use `auth:sanctum` middleware for authentication.
2. Replace `{id}` and other placeholders with actual IDs.
3. Admin-specific actions require `AdminMiddleware`.
