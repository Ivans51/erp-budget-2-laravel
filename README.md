# ERP Budget Laravel

<p>
  A comprehensive ERP system built with Laravel, focusing on budget management and organizational operations.
</p>

## About This Project

This is an Enterprise Resource Planning (ERP) application developed using the Laravel framework. It implements a domain-driven design approach with separate modules for Finance and Organization management, providing tools for effective budget planning, tracking, and organizational administration.

### Key Features

- **Finance Module**: Budget management, financial tracking, and reporting
- **Organization Module**: User management, organizational structure, and access control
- **Domain-Driven Design**: Clean architecture with separated business logic
- **Modern Tech Stack**: Laravel 12, PostgreSQL, Redis, Tailwind CSS, Vite

## Installation

### Prerequisites

- Docker & Docker Compose (for Laravel Sail)
- PHP 8.2+
- Composer
- Node.js & pnpm

### Setup

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd erp-budget-laravel
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install Node.js dependencies:
   ```bash
   pnpm install
   ```

4. Copy environment file and generate key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Start the development environment:
   ```bash
   ./vendor/bin/sail up -d
   ```

6. Run database migrations:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

7. Build assets:
   ```bash
   ./vendor/bin/sail pnpm run build
   ```

### Development

To start the development server with hot reloading:

```bash
composer run dev
```

This will start:
- Laravel server
- Queue worker
- Log monitoring
- Vite dev server

## Usage

Access the application at `http://localhost` (or the configured port).

## Testing

Run the test suite:

```bash
composer run test
```

## Code Quality

- **Linting**: `composer run format`
- **Static Analysis**: `composer run phpstan`

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'feat: add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Built With

- [Laravel](https://laravel.com/) - The PHP framework
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS framework
- [Vite](https://vitejs.dev/) - Fast build tool
- [PostgreSQL](https://www.postgresql.org/) - Database
- [Redis](https://redis.io/) - Caching and queues
- [Laravel Sail](https://laravel.com/docs/sail) - Docker development environment
