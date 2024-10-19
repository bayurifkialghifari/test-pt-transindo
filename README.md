# Login

## Admin

```
admin@admin.com
password
```

## Customer

```
customer@customer.com
password
```

## Merchant

```
merchant@merchant.com
password
```

# Installation

```
git clone
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
php artisan serve
```

## Folder Yang Sering Kepake

```
.
├── app/
│   ├── Http/
│   │   └── Api
│   ├── Livewire/
│   │   ├── Cms
│   │   └── Form
│   ├── Models
│   ├── Providers
│   └── Traits
├── config
├── database
├── resources/
│   └── views/
│       ├── components
│       └── livewire
└── routes
```
