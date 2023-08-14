# Department and Employee Management System 🏢👩‍💼

This is a simple Symfony application for managing departments and employees, created by Meryem Barkallah. It's a small school project that demonstrates the use of Symfony, Twig templates, and MySQL.

## Getting Started 🚀

These instructions will guide you through setting up the project on your local machine.

### Prerequisites 📋

- PHP (>= 7.2)
- Composer (https://getcomposer.org/)
- MySQL server

### Installation ⚙️

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/department-employee-manager.git
    cd department-employee-manager
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Configure the Database:

    Update the `.env` file with your MySQL database credentials:

    ```dotenv
    DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
    ```

4. Create the database schema:

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:schema:create
    ```

### Usage 🖥️

1. Run the Symfony development server:

    ```bash
    php bin/console server:run
    ```

2. Access the application in your web browser at `http://localhost:8000`.

3. Navigate to "/departments" and "/employees" to manage departments and employees, respectively.

### Customization 🎨

- You can customize the layout and styling by modifying the Twig templates located in the `templates/` directory.

- To add more features or improve the application, refer to Symfony and Twig documentation for guidance.

## License 📄

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
