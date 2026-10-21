# UAC Japan — Improvement Plan

## 1. "UAC nima?" (What is UAC?) section ✅ DONE
- Added a clear, concise "What is UAC?" block on the home page (and/or About page) explaining purpose & activities.
- Source: `config/uac.php` → `about` / new `what_is_uac` key; view: `resources/views/pages/home.blade.php`.

## 2. Annual events calendar + photo slider ✅ DONE
- Added an annual events calendar section (list of upcoming events with dates).
- Added auto-rotating photo slider (past event photos) on home page.
- Data: extend `config/uac.php` with `events` (upcoming) and `event_gallery` (past photos).
- View + JS: home page slider component, Tailwind styling.

## 3. Regional responsible persons (madoguchilar) ✅ DONE
- For each region, display responsible contact person(s) with name, role, email/phone/Telegram.
- Data: extend region entries in `config/uac.php` with `contacts`/`responsibles`.
- Views: `regions/index.blade.php`, `regions/show.blade.php`.

## 4. Social links: drop Instagram, keep Facebook + Telegram ✅ DONE
- Update footer/navbar social links to remove Instagram, keep Facebook & Telegram.
- Data: `config/uac.php` social links; views: `partials/footer.blade.php`, `partials/navbar.blade.php`.

## 5. Membership system (phased) 🔄 Phase 1 done, Phase 2 pending
- Phase 1: Static "Join Us" page improvements + application form (name, email, field, region). ✅ UI exists
- Phase 2: Store applications (DB migration + model + controller). ⏳ pending
- Phase 3: Admin review / member directory (optional, later).

## Implementation order (suggested)
1. Content config updates (uac.php) for items 1, 2, 3, 4. ✅
2. Home page "What is UAC" + events calendar + photo slider. ✅
3. Region responsible persons display. ✅
4. Social links cleanup. ✅
5. Membership Phase 1 form. ✅ (UI exists)
6. Membership Phase 2 backend. ⏳ pending

## Token estimate (rough)
- Plan + small edits: ~5k–15k tokens.
- Full implementation of all 5 items with views/JS: ~40k–120k tokens depending on iterations.
- Tokens used so far this session: ~11.4M. Recommend doing in focused chunks per item to control cost.

## Notes
- Max creativity: bilingual/trilingual copy (en/uz/ja), clean Tailwind, smooth slider, accessible markup.
- Confirm each phase before applying changes.

## Deployment
- Hosting: DirectAdmin (uacjp.uz), SSH available.
- Repo cloned at /home/uacjpuz/laravel_app, public_html symlinks to laravel_app/public.
- Deploy: SSH → git pull origin main → artisan config:clear/view:clear/cache:clear.
- Last deploy: pulled 4f75769..72b5a00, site returns 200.
- ⚠️ Credentials were shared in chat — recommend changing the password.
- .env still has APP_DEBUG=true and APP_ENV=local — consider tightening for production.
