# docker.md

This Laravel project uses Docker with Laravel Sail for local development environment management. Sail provides a
lightweight command-line interface for interacting with Laravel's Docker configuration, allowing for consistent
development environments across different operating systems.

## Guidelines

- Always run `php artisan` commands using `./vendor/bin/sail artisan` to ensure commands execute within the Docker
  container environment
