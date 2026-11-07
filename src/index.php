<?php

// The backend: bundled into api/index.php, served by Vercel at /api/*
// exura.php is bundled before this file, so Exura is ready.

// GET /api/rune
// Vercel may hand the route with or without its folder: api/rune or rune
foreach (['api/rune', 'rune'] as $route) {
  Exura::module('GET', $route, function() {
    return [
      'data'=> [
        'message'=> 'Answered by ExuraPHP on Vercel at ' . gmdate('H:i:s') . ' UTC',
      ],
    ];
  });
}

// nothing matched: 404 as JSON
Exura::fallback();
