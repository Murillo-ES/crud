# e-Commerce Project (Work in Progress)

This is a simple **CRUD (Create, Read, Update, Delete) application** built using **PHP** and **Laravel**. It is a work in progress and serves as a learning project as I improve my skills as a beginner developer.

## Features

✅ **Product Management** (Add, Edit, Delete, List)  
✅ **Livewire Integration** for dynamic UI updates  
✅ **Sorting & Filtering** for products  
✅ **Shopping Cart** with item quantity control  
✅ **Database Relationships** (One-to-Many between Users and Products)  
✅ **Custom Blade Components** for reusability

## API Features

To start utilizing the API features, you should first follow the [Installation](#installation) section of the README document.

After that, utilize your preferred API platform. As a recommendation, I used [Postman](https://www.postman.com/) for all the API tests regarding this project.

### Products

🔗 **GET** `/api/products?minPrice=[float]&maxPrice=[float]&sort=[asc || desc]`  
Returns a list of all products currently on the database.

Query strings are all **optional** and will sort the result based on the parameters passed.

🔗 **GET** `/api/products/{id}`  
Returns the specified product by ID.  
```json
{
   "id": 1,
   "user_id": 1,
   "name": "Product Name",
   "description": "Product Description",
   "price": 1.10,
   "stock": 1,
   "onCart": 0
}
```

🔗 **PUT** `/api/products/create?name=[string]&description=[string]&price=[float]&stock=[int]`  
Creates a new product and saves it on the database.

**Query Strings**  
- "name" (**Required**) -> Product's name. Maximum of 255 characters.
- "description" -> Product's description. If nothing is passed, *"No description."* is set by default.
- "price" (**Required**) -> Product's price. Minimum value: 0.99.
- "stock" -> Product's quantity. Minimum value: 1. Maximum value: 999. If nothing is passed, *1* is set by default.

If "name" is already on the database:  
```json
{
   "response": "Product already exists",
   "id": [Product ID]
}
```

If "name" is not on the database, a new product is created.  
```json
{
   "response": "Product created succesfully!",
   "id": [New Product ID]
}
```

🔗 **PATCH** `/api/products/{id}?name=[string]&description=[string]&price=[float]&stock=[int]`  
Updates the product by its ID with the data passed via query strings.

**Query Strings**  
- "name" -> Updated product name. Maximum of 255 characters.
- "description" -> New product description.
- "price" -> New product price. Minimum value: 0.99.
- "stock" -> New product quantity. Minimum value: 0. Maximum value: 999.

If no query strings are passed:  
```json
{
   "response": "No changes made to product ID #[Product ID]."
}
```

If query strings with different values from the original product's data are passed:  
```json
{
   "response": "Product ID #[Product ID] updated succesfully.",
   "updatedProduct": [Product JSON]
}
```

🔗 **DELETE** `/api/products/{id}`  
Deletes the product by its ID.  
```json
{
   "response": "Product with ID [Product ID] deleted succesfully!",
}
```

### Users
🔗 **GET** `/api/users`  
Returns a list of all users currently on the database.

🔗 **GET** `/api/users/{id}`  
Returns the specified user by ID.  
```json
{
   "id": 1,
   "name": "username",
   "email": "user@email.com",
   "created_at": "01-01-2025",
   "products": [List of User's products]
}
```

## Future Features

These are features that I intend on implementing on this application in the near future.

📌 **Login and Auth**  
Utilizing **Breeze**, I'll implement login, registration and auth factors, so that a user can register, login and create products using his own account.

📌 On top of those changes, I intend to **review** and **refactor** the code constantly, as to improve its longevity and readability.

## Installation

To set up and run this project locally, follow these steps:

1. Clone this repository:
   ```sh
   git clone https://github.com/Murillo-ES/crud.git
   cd crud
   ```
2. Install dependencies:
   ```sh
   composer install
   npm install
   ```
3. Copy the environment file and set up your database:
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
4. Migrate the database:
   ```sh
   php artisan migrate --seed
   ```
5. Start the development server:
   ```sh
   php artisan serve
   ```

## Usage

- Manage products (add, edit, delete, and view them in a paginated list).
- Sort and filter products based on different criteria.
- View users and the products they are currently linked to.
- Add products to the cart and adjust the quantity before checkout.

## Notes

🚀 **This project is still under development**, and more features will be added over time. Since I'm a beginner, feedback and suggestions are always welcome!

## License

This project is open-source and free to use under the [MIT License](LICENSE).

---

**Contact:** If you have any questions or suggestions, feel free to reach out!
