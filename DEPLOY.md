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

### 1. Pick a deploy method

Under **Settings → Secrets and variables → Actions → Variables**, set
`DEPLOY_METHOD`:

| Value | When to use | Limitation |
| --- | --- | --- |
| `ssh` | The hosting package has shell access (DirectAdmin shows an **SSH Keys** section). Preferred. | — |
| `ftp` (default) | No shell access. | Cannot run migrations or rebuild Laravel caches; those stay manual. |

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
| `PHP_VERSION` | `8.4` | **Must match the server's PHP version.** See the warning below. |
| `DEPLOY_PATH` | `/home/uacjpuz/laravel_app` | ssh only |
| `SSH_PORT` | `22` | ssh only |
| `PHP_BIN` | `php` | ssh only; some accounts need an absolute path such as `/usr/local/php83/bin/php` |
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

## Known issue: PHP version

`composer.lock` currently pins Symfony 8.1 components that require
**PHP >= 8.4.1**, while `composer.json` declares `"php": "^8.3"`. If the
hosting account runs PHP 8.3, `composer install` cannot succeed there and the
lockfile has to be regenerated against PHP 8.3. Check the account's PHP version
in DirectAdmin and set `PHP_VERSION` to match; CI will fail loudly if the
lockfile and that version disagree.

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
