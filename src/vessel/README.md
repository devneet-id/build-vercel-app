# Vessel

**Every library of this app lives here: Exura and Vercel.**

The vessel is a folder of libraries, carried by the runites into the app. `php cast build` takes it per folder, before `src/index.*`, and splits it by language: no need to list a file in `cast`.

| File | From | Goes into |
| ---- | ---- | --------- |
| `exura.css` | `php exura css` | `dist/index.html` (`<style>`) |
| `exura.js` | `php exura js` | `dist/index.html` (`<script>`) |
| `exura.php` | `php exura php` | `api/index.php` |
| `vercel.php` | `php vercel code` | `api/index.php` |

`php exura setup` fetches Exura here (`EXURA_DIST = 'src/vessel/'`), `php vercel code` writes `vercel.php` here (`VERCEL_CODE`). Another library goes beside them, named after itself: `name.css`, `name.js`, `name.php`.

Other files (images, this README) stay out of the bundles, but still travel with the relic as shards.
