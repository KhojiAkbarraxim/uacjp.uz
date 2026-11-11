# UAC Japan

Production-oriented Laravel website for the Uzbek Academic Club in Japan (`uacjp.uz`). The project uses Blade, Tailwind CSS v4, Vite, and lightweight JavaScript to reproduce the academic design language defined in the included Stitch reference files.

## Tech Stack

- Laravel 13
- Blade templates
- Tailwind CSS v4 with `@tailwindcss/vite`
- Vite
- Vanilla JavaScript

## Installation

1. Install PHP dependencies:

```bash
composer install
```

2. Install frontend dependencies:

```bash
npm install
```

3. Create the environment file if needed and generate the application key:

```bash
cp .env.example .env
php artisan key:generate
```

4. Start the Laravel development server:

```bash
php artisan serve
```

5. Start the Vite development server in a separate terminal:

```bash
npm run dev
```

## Build Commands

Development build watcher:

```bash
npm run dev
```

Production build:

```bash
npm run build
```

## Content Management

Static sample content for the site lives in [config/uac.php](/home/khojiakbar/projects/uacjp/config/uac.php). Update that file to edit:

- regional chapter data
- activities
- members
- secretary members
- partners
- FAQs
- navigation links
- contact and join page content

## Project Structure

- [routes/web.php](/home/khojiakbar/projects/uacjp/routes/web.php): named public routes
- [app/Http/Controllers](/home/khojiakbar/projects/uacjp/app/Http/Controllers): page, region, and member controllers
- [resources/views](/home/khojiakbar/projects/uacjp/resources/views): layouts, partials, components, and page templates
- [resources/css/app.css](/home/khojiakbar/projects/uacjp/resources/css/app.css): Tailwind theme tokens and shared component classes
- [resources/js/app.js](/home/khojiakbar/projects/uacjp/resources/js/app.js): mobile menu, FAQ accordion, and member filter behavior

## Production: apex domain TLS

`https://uacjp.uz` (without `www`) fails with `NET::ERR_CERT_COMMON_NAME_INVALID`.
DNS is not the problem — both names already resolve to the same host:

```
uacjp.uz      A  95.46.96.12
www.uacjp.uz  A  95.46.96.12
```

The certificate is issued for `www.uacjp.uz` alone:

```
subject=CN = www.uacjp.uz
X509v3 Subject Alternative Name: DNS:www.uacjp.uz
```

This is DirectAdmin shared hosting with no root access, so the certificate is
reissued from the panel, not with `certbot`. See **DEPLOY.md → TLS** for the
steps; `public/.htaccess` already keeps `/.well-known/` reachable so the
Let's Encrypt challenge is not blocked.

Verify afterwards with `curl -sSI https://uacjp.uz | head -1`.
