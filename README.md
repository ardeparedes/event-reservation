# Online Event Reservation System

### Installation

First, clone this repository to your local machine using the command `git clone <repository_url>`. After that, navigate to the project directory and install the required dependencies by running `composer install`.

Next, create a copy of the `.env.example` file and rename it as `.env`. Open the `.env` file and update the environment variables to match your specific configuration.

Ensure that your application's `APP_URL` and `FRONTEND_URL` environment variables are set to `http://localhost:8000` and `http://localhost:3000`, respectively.

Once you have set up the environment variables in the `.env` file, you can run the following command to migrate the database and seed it with sample data:

```bash
php artisan migrate:fresh --seed
```

This command will create all the necessary database tables and populate them with the predefined seed data.

After running the migration and seed command, you can serve the Laravel application by running the following command:

```bash
php artisan serve
```

This will start a local development server, and you can access the application through your web browser at `http://localhost:8000`.
