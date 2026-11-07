# Build Vercel App

**Forged through Rune. Shaped with Exura. Shipped on Vercel.**

A small web app built with Rune and the Exura series, deployed on **[Vercel](https://vercel.com)**: a static page in `public/`, an API in `api/` that runs as a Vercel PHP function. Write it in many small files in `src/`, and Rune bundles them into two.

**[Explore Rune ↗](https://github.com/devneet-id/rune)**
**[Explore Exura ↗](https://github.com/devneet-id/exura)**

![The page on desktop](public/assets/snapshot.jpg)

<p align="center"><img src="public/assets/snapshot-mobile.jpg" alt="The page on mobile" width="260"></p>

---

## Made with Rune

This app holds three **runites**, all engraved from the origin runes of **[Rune](https://github.com/devneet-id/rune)**, a lore-driven, modular concept beneath PHP:

| Runite | Job |
| ------ | --- |
| `cast` | builds, serves, watches and stores the app |
| `exura` | installs and removes the Exura series from the CDN |
| `vercel` | logs in and pushes the app to Vercel |

| Rune | Role in this app |
| ---- | ---------------- |
| Aether | opens and closes the flow |
| Chanter | registers the casts |
| Whisper | speaks to the user and asks |
| Weaver | fills the templates while bundling |
| Crafter | bundles `src/` into `public/index.html` and `api/index.php` |
| Forger | fetches, writes and removes files |
| Cipher | gives every bundle its hash |
| Keeper | remembers the shards in `.echoes` |
| Specter | serves, watches, and runs the Vercel CLI beside the flow |

Want to engrave your own? Start from the **[Rune repository](https://github.com/devneet-id/rune)**.

### Requirements

* PHP 8.1+ with `curl` (or `allow_url_fopen`)
* Composer
* [Vercel CLI](https://vercel.com/docs/cli) *(to deploy)*: `npm i -g vercel`

### Install

```bash
composer install
php exura setup
php cast start
```

Then open `http://127.0.0.1:8000` and press **Test API**.

---

## The App

```
src/
├── exura/            exura.css · exura.js · exura.php (php exura setup)
├── index.head.html   goes into <head>
├── index.html        goes into <body>
├── index.css         becomes <style>
├── index.js          becomes <script>
└── index.php         the API
public/
├── index.html        the page (php cast build)
└── assets/
    ├── background.jpg
    └── snapshot*.jpg   the pictures of this README
api/
└── index.php         the API (php cast build), a Vercel function
vercel.json           the routes and the PHP runtime of Vercel
router.php            the same routes, locally (php cast serve)
```

`php cast build` sparks two items:

| Item | From | To | Holds |
| ---- | ---- | -- | ----- |
| `frontend` | `src/exura/*`, `src/index.*` (html, css, js) | `public/index.html` | the page, with ExuraCSS and ExuraJS inside |
| `backend` | `src/exura/exura.php`, `src/index.php` | `api/index.php` | the API, with ExuraPHP inside |

* Edit only `src/`. `public/index.html` and `api/index.php` are made by `php cast build`.
* Put images and fonts in `public/assets/`. The page reads them as `assets/...`.
* **The background** is `public/assets/background.jpg`. Drop your own image there, no rebuild needed.

| Exura part | In this app |
| ---------- | ----------- |
| ExuraCSS | layout as attributes (`flex`, `size`, `misc`, `button`) and dark mode with `body[dark]` |
| ExuraJS | the `<exura-rune>` module: the **Test API** button, its status and the message |
| ExuraPHP | `GET /api/rune`, answered as JSON; any other `/api/*` answers `404` |

### The routes

`vercel.json` sends every request to the right place:

| Request | Goes to |
| ------- | ------- |
| `/api/*` | `api/index.php` (runtime `vercel-php`) |
| `/*` | `public/*` |

Locally, `php cast serve` runs `router.php`, which reads the same `vercel.json` on every request — change the routes once, both sides follow. `router.php` and `src/` are left out of the deploy by `.vercelignore`.

---

## Registered Casts

### cast

| Cast | Description |
| ---- | ----------- |
| `build` | Bundle `src/` into `public/index.html` and `api/index.php`, then store. |
| `serve` | Serve like Vercel on `127.0.0.1:8000`. |
| `watch` | Rebuild when `src/` changes. |
| `start` | Build, then serve and watch. |
| `store` | Keep the assets as shards. |

### exura

| Cast | Spells | Description |
| ---- | ------ | ----------- |
| `setup` | `--dist` `--tags` `--install` | Set where and which version, then install. |
| `css` | `--install` `--remove` `--tags` `--part=clip` | Install or remove `exura.css` (or `exura-clip.css`). |
| `js` | `--install` `--remove` `--tags` | Install or remove `exura.js`. |
| `php` | `--install` `--remove` `--tags` | Install or remove `exura.php`. |

* Keep Exura in `src/exura/`: both items bundle it from there.
* `--tags` is a tag (`1.1.0`) or a branch (`1.x`, the latest of 1.x). Without it, `EXURA_TAGS` is used.

### vercel

| Cast | Description |
| ---- | ----------- |
| `link` | Log in to Vercel. |
| `push` | Publish to Vercel (`vercel --prod`). |

---

## Try it

Run every command inside this folder.

**The main screens** — every cast with its echo:

```bash
php cast
php exura
php vercel
```

**Exura** — install the series:

```bash
php exura setup                                        # asks: where? install now?
php exura setup --dist=src/exura/ --tags=1.1.0 --install
```

**Build and develop** — `serve` and `watch` run until **Ctrl+C**:

```bash
php cast build
php cast serve                                         # http://127.0.0.1:8000, like Vercel
php cast watch                                         # rebuild on every change in src/
php cast start                                         # build, then serve & watch in their own windows
```

**The API** — locally, then on Vercel:

```bash
curl "http://127.0.0.1:8000/api/rune"
curl "https://<your-app>.vercel.app/api/rune"
```

**Ship** — to Vercel:

```bash
php vercel link                                        # once: log in
php cast build
php vercel push                                        # vercel --prod
```

**Share** — the runites and their shards as one relic:

```bash
php cast store
php cast reliquary --runite-relic                      # cast -> cast.rune
```

---

## What you learn

| Runite · Cast | Lesson |
| ------------- | ------ |
| `cast build` | Crafter: two items from one `src/`, each with its own seed |
| `cast serve`, `watch`, `start` | Specter: a dev server with a router, an observer, casts beside the flow |
| `cast store` | Keeper: shards travel with the relic |
| `exura setup`, `css`, `js`, `php` | Whisper asks; Forger fetches, writes and removes |
| `vercel link`, `push` | Specter runs another CLI beside the flow |

**A web app is many files, Rune makes it two, Vercel ships them.**

---

## References

* [Rune](https://github.com/devneet-id/rune) — Application foundation and tooling.
* [Rune Lore](https://github.com/devneet-id/rune-lore) — The full documentation, from the void to the beyond.
* [ExuraCSS](https://github.com/devneet-id/exuracss) — Styling framework.
* [ExuraJS](https://github.com/devneet-id/exurajs) — JavaScript framework.
* [ExuraPHP](https://github.com/devneet-id/exuraphp) — PHP framework.
* [Vercel](https://vercel.com) — The platform this app is shipped on.
* [vercel-php](https://github.com/vercel-community/php) — The PHP runtime for Vercel functions.

---

**Built to create. Designed to evolve.**

**DEVNEET ©**
