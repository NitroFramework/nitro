# NitroPHP

The application skeleton for [NitroPHP](https://github.com/NitroFramework/framework): Laravel, with
a compiled, lean request path.

```bash
composer create-project nitro/nitro my-app
cd my-app
php artisan serve
```

This is the stock `laravel/laravel` skeleton. It differs in two lines:

- `composer.json` requires `nitro/framework` instead of `laravel/framework`
- `bootstrap/app.php` imports `Nitro\Foundation\Application`

Everything else is Laravel: follow the [Laravel documentation](https://laravel.com/docs). For
workers, use [Laravel Octane](https://laravel.com/docs/octane).

Apps that need the previous standalone Nitro engine can stay on `nitro/framework ^0.39`.

## License

MIT.
