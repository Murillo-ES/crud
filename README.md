# e-Commerce Project (Work in Progress)

This is a simple **CRUD (Create, Read, Update, Delete) application** built using **PHP** and **Laravel**. It is a work in progress and serves as a learning project as I improve my skills as a beginner developer.

## Features

✅ **Product Management** (Add, Edit, Delete, List)  
✅ **Livewire Integration** for dynamic UI updates  
✅ **Sorting & Filtering** for products  
✅ **Shopping Cart** with item quantity control  
✅ **Database Relationships** (One-to-Many between Users and Products)  
✅ **Custom Blade Components** for reusability

## Future Features

This are features that I intend on implementing on this application in the near future.

📌 **API Features** -> Although the initial API was already set, many other features were implemented since the initial coding, rendering it obsolete. I intend to address those issues initially.

📌 **List of Users to PDF/CSV** -> The products list already has that feature implemented. A similar one will be added to the Users' list.

📌 **New Home Screen** -> Currently, the "Home" button redirects the user to the Products list. A separate Home route will be added.

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
