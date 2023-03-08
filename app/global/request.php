<?php

// Redirect To any root route
function redirectTo($url)
{
   header('location:' . URLROOT . $url);
   exit;
}

function redirect($url)
{
   header('location:' . $url);
   exit;
}

function UrlPath()
{
   if (isset($_GET['urlPath'])) {
      $urlPath = rtrim($_GET['urlPath'], '/');
      $urlPath = filter_var($urlPath, FILTER_SANITIZE_URL);
      $urlPath = explode('/', $urlPath);
      return $urlPath;
   } else {
      return [];
   }
}

// math with current url path
function matchRoute($path)
{
   $urlPath = UrlPath();
   return (count($urlPath) > 0 ? '/' . $urlPath[0] . (isset($urlPath[1]) ? '/' . $urlPath[1] : '') : '/') == $path;
}

// route Path 

function routePath()
{
   $urlPath = UrlPath();
   return (count($urlPath) > 0 ? '/' . $urlPath[0] . (isset($urlPath[1]) ? '/' . $urlPath[1] : '') : '/');
}

// previous url 
function prev_url()
{
   return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : URLROOT;
}

// current url
function current_url()
{
   $currentUrl = 'http';
   if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
      $currentUrl .= "s";
   $currentUrl .= "://";
   if ($_SERVER['SERVER_PORT'] !== '80')
      $currentUrl .= $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
   else
      $currentUrl .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

   return $currentUrl;
}
