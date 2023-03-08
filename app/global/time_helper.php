<?php


// Returns a string representing the time elapsed in a human-readable format
function time_elapsed_string($timestamp)
{
   $elapsed = time() - $timestamp;

   if ($elapsed < 60) {
      return 'just now';
   } else if ($elapsed < 3600) {
      $mins = floor($elapsed / 60);
      return $mins . ' ' . ($mins == 1 ? 'minute' : 'minutes') . ' ago';
   } else if ($elapsed < 86400) {
      $hours = floor($elapsed / 3600);
      return $hours . ' ' . ($hours == 1 ? 'hour' : 'hours') . ' ago';
   } else if ($elapsed < 604800) {
      $days = floor($elapsed / 86400);
      return $days . ' ' . ($days == 1 ? 'day' : 'days') . ' ago';
   } else {
      return date('M j, Y', $timestamp);
   }
}
