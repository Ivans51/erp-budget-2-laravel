# ERP Budget 2 - Laravel

![Laravel](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

A modern ERP Budget management system built with Laravel 12, designed to help organizations manage their financial planning, budgeting, and resource allocation efficiently.

## 🚀 Features

- **Budget Management**: Create, track, and manage organizational budgets
- **Financial Planning**: Comprehensive tools for financial forecasting and planning
- **Resource Allocation**: Optimize resource distribution across departments
- **Reporting & Analytics**: Generate detailed financial reports and insights
- **User Management**: Role-based access control for secure budget management
- **Modern UI**: Built with Tailwind CSS and Vite for a responsive interface

## 📋 Project Structure

```
erp-budget-2-laravel/
├── app/                  # Core application logic
│   ├── Http/             # Controllers and middleware
│   ├── Models/           # Eloquent models
│   └── Providers/        # Service providers
├── bootstrap/            # Framework bootstrap files
├── config/               # Configuration files
├── database/             # Migrations, seeders, and factories
├── public/               # Public assets and entry point
├── resources/            # Views, CSS, and JavaScript
├── routes/               # Application routes
├── storage/              # Logs, cache, and compiled files
├── tests/                # PHPUnit tests
└── vendor/               # Composer dependencies
```

## 🛠️ Technology Stack

- **Backend**: Laravel 12, PHP 8.2+
- **Frontend**: Tailwind CSS, Vite, Alpine.js
- **Database**: SQLite (default), MySQL/PostgreSQL supported
- **Testing**: PHPUnit, Pest
- **Development Tools**: Laravel Sail, Laravel Pint, Laravel Tinker

## 📦 Requirements

- PHP 8.2 or higher
- Composer 2.0+
- Node.js 18+ (for frontend assets)
- SQLite or MySQL/PostgreSQL database

## 🔧 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/erp-budget-2-laravel.git
cd erp-budget-2-laravel
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Set Up Environment

Copy the example environment file and generate application key:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Install JavaScript Dependencies

```bash
npm install
```

### 5. Run Database Migrations

```bash
php artisan migrate
```

### 6. Build Frontend Assets

```bash
npm run build
```

## 🚀 Running the Application

### Development Mode

```bash
php artisan serve
npm run dev
```

### Production Mode

```bash
php artisan serve --env=production
npm run build
```

## 📖 Usage Examples

### Creating a New Budget

```php
// Example controller method for creating budgets
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'department_id' => 'required|exists:departments,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ]);

    $budget = Budget::create($validated);

    return redirect()->route('budgets.show', $budget)
        ->with('success', 'Budget created successfully!');
}
```

### Generating Budget Reports

```php
// Example report generation
public function generateReport($budgetId)
{
    $budget = Budget::with(['transactions', 'department'])->findOrFail($budgetId);

    $reportData = [
        'budget' => $budget,
        'total_spent' => $budget->transactions->sum('amount'),
        'remaining' => $budget->amount - $budget->transactions->sum('amount'),
        'percentage_used' => ($budget->transactions->sum('amount') / $budget->amount) * 100,
    ];

    return view('reports.budget', $reportData);
}
```

## 🧪 Testing

Run the test suite:

```bash
php artisan test
```

## 🤝 Contributing

We welcome contributions to ERP Budget 2! Please follow these guidelines:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes with descriptive messages
4. Push to your branch: `git push origin feature/your-feature-name`
5. Open a Pull Request

### Development Workflow

```bash
# Install dependencies
composer install
npm install

# Run development server with hot reloading
composer run dev

# Run tests
php artisan test

# Format code
composer pint
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🔒 Security

If you discover any security vulnerabilities, please email security@erp-budget.com instead of using the issue tracker.

## 📬 Contact

For questions or support, please contact:

- **Email**: support@erp-budget.com
- **Website**: https://erp-budget.com
- **GitHub Issues**: https://github.com/your-username/erp-budget-2-laravel/issues

---

> "Budgeting is not just about numbers, it's about making informed decisions for your organization's future." - ERP Budget Team
