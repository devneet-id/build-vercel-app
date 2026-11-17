<?php

/* VERCEL
 * the API on Vercel: environment variables and where it runs
 * made by 'php vercel code', bundled into api/index.php by 'php cast build'
 * */
class Vercel {

  // an environment variable (php vercel env:set), or its default
  public static function env( String $key, $default = null ) {
    $value = getenv($key);
    return $value === false ? $default : $value;
  }

  // true when this request runs on Vercel
  public static function is() {
    return getenv('VERCEL') === '1';
  }

  // production, preview or development
  public static function target() {
    return getenv('VERCEL_ENV') ?: 'development';
  }

  // the url of this deployment, e.g. https://my-app-abc123.vercel.app
  public static function url() {
    $url = getenv('VERCEL_URL');
    return $url ? "https://$url" : null;
  }

  // the region of this function, e.g. iad1
  public static function region() {
    return getenv('VERCEL_REGION') ?: null;
  }

}
