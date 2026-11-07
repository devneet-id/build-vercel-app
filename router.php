<?php
/*
 * ROUTER
 * Vercel locally: the routes of vercel.json, read on every request,
 * so the local server answers the same way Vercel does.
 *
 * Used by:
 *   $ php cast serve   ->   php -S 127.0.0.1:8000 router.php
 *
 * [i]INFO: only for local development, never deployed (.vercelignore)
 */

$root = __DIR__;
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');
$config = json_decode((string) file_get_contents("$root/vercel.json"), true) ?: [];

foreach ($config['routes'] ?? [] as $route) {
  // a Vercel route matches the whole path: ^src$
  if (!preg_match('#^' . str_replace('#', '\#', $route['src']) . '$#', $path, $match)) {
    continue;
  }

  // $1, $2, ... in dest come from the groups of src
  $dest = preg_replace_callback('/\$(\d+)/', fn($m) => $match[(int) $m[1]] ?? '', $route['dest']);
  $file = $root . '/' . ltrim($dest, '/');
  if (is_dir($file)) {
    $file = rtrim($file, '/') . '/index.html';
  }

  // no file: try the next route
  if (!is_file($file) || !str_starts_with(realpath($file), $root)) {
    continue;
  }

  // a PHP function, run as Vercel runs it
  if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    $_SERVER['SCRIPT_NAME'] = '/' . ltrim($dest, '/');
    $_SERVER['SCRIPT_FILENAME'] = $file;
    chdir(dirname($file));
    require $file;
    return true;
  }

  // a static file
  $types = [
    'html'=> 'text/html; charset=utf-8',
    'css'=> 'text/css',
    'js'=> 'text/javascript',
    'json'=> 'application/json',
    'svg'=> 'image/svg+xml',
    'png'=> 'image/png',
    'jpg'=> 'image/jpeg',
    'jpeg'=> 'image/jpeg',
    'webp'=> 'image/webp',
    'ico'=> 'image/x-icon',
  ];
  header('Content-Type: ' . ($types[strtolower(pathinfo($file, PATHINFO_EXTENSION))] ?? 'application/octet-stream'));
  readfile($file);
  return true;
}

// nothing matched
http_response_code(404);
echo '404 Not Found';
return true;
