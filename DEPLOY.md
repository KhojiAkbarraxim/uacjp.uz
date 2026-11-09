# Deployment

The site runs on a DirectAdmin shared hosting account (`uacjpuz` on
`web2.webspace.uz`). The Laravel application lives **outside** the web root, in
`/home/uacjpuz/laravel_app`, and `~/public_html` contains only symlinks into
`laravel_app/public`. That is deliberate: it keeps `.env`, `vendor/` and
`storage/` unreachable from the internet. Do not move the application into
`public_html`.

## How a change reaches production

1. Push to a branch, open a pull request. `.github/workflows/ci.yml` installs
   dependencies, builds the assets and runs the test suite.
2. Merge into `main`. `.github/workflows/deploy.yml` builds a release and
   uploads it.

`public/build` is gitignored, so the compiled CSS/JS never travels through git.
The deploy workflow builds it on GitHub and ships it, which means the hosting
account does not need Node.js.

## One-time setup

### 1. Deploy method

The account has shell access, so `DEPLOY_METHOD` is set to `ssh` under
**Settings -> Secrets and variables -> Actions -> Variables**. That is the
preferred path: it is the only one that can run migrations and rebuild
Laravel's caches after upload.

The `ftp` value remains as a fallback for an account without shell access. It
uploads code and assets, but migrations and caches stay manual.

### 2. Add the secrets

Under **Settings → Secrets and variables → Actions → Secrets**:

| Method | Secret | Value |
| --- | --- | --- |
| ssh | `SSH_HOST` | `web2.webspace.uz` |
| ssh | `SSH_USER` | the hosting account user |
| ssh | `SSH_PRIVATE_KEY` | private key whose public half is registered in DirectAdmin → SSH Keys |
| ssh | `SSH_KNOWN_HOSTS` | output of `ssh-keyscan web2.webspace.uz` (optional but recommended) |
| ftp | `FTP_SERVER` | `uacjp.uz` |
| ftp | `FTP_USERNAME` | the FTP account user |
| ftp | `FTP_PASSWORD` | the FTP account password |

Never commit these values. Rotate the hosting password if it has ever been
pasted into a chat, an issue or a commit message.

### 3. Optional variables

| Variable | Default | Notes |
| --- | --- | --- |
| `PHP_VERSION` | `8.4` | Matches the server's PHP 8.4.27; leave as is. |
| `DEPLOY_PATH` | `/home/uacjpuz/laravel_app` | ssh only |
| `SSH_PORT` | `22` | ssh only |
| `PHP_BIN` | `php` | ssh only; `php` resolves to 8.4.27 on this account |
| `FTP_SERVER_DIR` | `laravel_app/` | ftp only; relative to the FTP login directory |
| `FTP_PROTOCOL` | `ftps` | ftp only; set to `ftp` if the server has no TLS |

### 4. Do a dry run first

Run **Actions → Deploy to uacjp.uz → Run workflow** with `dry_run` left
checked. Nothing is written to the server; the log lists exactly which files
would change. Only then merge to `main`, where deploys run for real.

## What the deploy never touches

`.env`, `storage/`, `bootstrap/cache/`, `public/uploads/` and
`database/*.sqlite` are excluded from both upload and deletion. Live config,
sessions, logs and uploaded files are therefore safe.

## PHP version

The hosting account runs **PHP 8.4.27**, verified on the server. `composer.lock`
pins Symfony 8.1, which requires PHP >= 8.4.1, so it installs cleanly there even
though `composer.json` still declares the looser `"php": "^8.3"`. The
`PHP_VERSION` variable therefore stays at its `8.4` default; if the account is
ever moved to PHP 8.3, the lockfile has to be regenerated first.

## Leftovers to remove from the web root

`~/public_html` still contains a stray `.git` directory (a second, unused
repository), a `.htaccess.bak` and an empty `nodebuild/`. They are currently
hidden only by the host's own Apache rules. `public/.htaccess` now denies
dotfiles itself, but the files should still be moved out of the web root:

```bash
mkdir -p ~/attic && mv ~/public_html/.git ~/public_html/.htaccess.bak ~/public_html/nodebuild ~/attic/
```

## TLS

The Let's Encrypt certificate covers `www.uacjp.uz` only, so `https://uacjp.uz`
fails certificate validation. Reissue it in DirectAdmin → SSL Certificates with
both `uacjp.uz` and `www.uacjp.uz` selected. `public/.htaccess` keeps
`/.well-known/` reachable so renewal is not blocked.
