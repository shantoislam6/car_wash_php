<?php

// Start session for every single pages
session_start();

// check user is authenticate or not
function is_auth_user()
{

   $rememberMeModel = new models\ModelRememberMe;

   if (isset($_COOKIE['xs']) && isset($_COOKIE['user_id']) && !empty($_COOKIE['xs']) && !empty($_COOKIE['user_id'])) {

      $allUserxs = $rememberMeModel->retrieveUserxs($_COOKIE['user_id']);

      
      if ($allUserxs) {

         foreach ($allUserxs as $userxs) {

            // verify the xs token with hashed xs token
            if (password_verify($_COOKIE['xs'], $userxs['xs'])) {

               // check whether xs token expired or not
               if ($userxs['expired_at'] > time()) {

                  set_user_session($userxs);

                  $_SESSION['xs_id'] = $userxs['xs_id'];
               } else {

                  // Delete expired xs record
                  $rememberMeModel->deleteExpiredXs($userxs['xs_id']);

                  unset_user_session();

                  flash_message("danger", "You cookie has been expired!!");
               }
               break;
            } else if (isset($_SESSION['xs_id']) && $userxs['xs_id'] == $_SESSION['xs_id']) {
               $rememberMeModel->deleteExpiredXs($_SESSION['xs_id']);
               unset_user_session();
               break;
            }
         }
      } else {
         if (isset($_SESSION['xs_id'])) {
            $rememberMeModel->deleteExpiredXs($_SESSION['xs_id']);
            unset_user_session();
            
         }
      }
   } else {
      if (isset($_SESSION['xs_id'])) {
         $rememberMeModel->deleteExpiredXs($_SESSION['xs_id']);
         unset_user_session();
      }
   }

   if (isset($_SESSION['xs_id'])) {
      return true;
   } else {
      return isset($_SESSION['user_id']) && isset($_SESSION['user_email']);
   }
}



// check user is verified or not 
function is_verified_user()
{
   return $_SESSION['is_verified'] == 1;
}

// check is admin or not
function is_admin()
{  
   // Add extra security for super admin
   return is_auth_user()  && isset($_SESSION['role']) && $_SESSION['role'] == 3;
}


// Set user session

function set_user_session($user)
{
   // make auth via session only

   $_SESSION['user_id'] = $user['id'];
   $_SESSION['user_email'] = $user['email'];
   $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];
   $_SESSION['is_verified'] = $user['is_verified'];
   $_SESSION['avatar_path'] = $user['avatar_path'];
   $_SESSION['role'] = $user['role'] > 2 ? 3 : 0;
}

// unset user session
function unset_user_session()
{
   unset($_SESSION['user_id']);
   unset($_SESSION['user_email']);
   unset($_SESSION['is_verified']);
   unset($_SESSION['role']);
   unset($_SESSION['name']);
   unset($_SESSION['avatar_path']);
   unset($_SESSION['xs_id']);
   unset($_SESSION['admin_secrete']);
}

function cookie_destroy()
{
   // regenerate the session ID
   session_regenerate_id();

   // destroy all cookies
   foreach ($_COOKIE as $name => $value) {
      setcookie($name, null, time() - 3600, '/');
   }
}


// Set flash message session
function flash_message($type, $body)
{
   $_SESSION['flash_message'] = json_encode([
      'type' => $type,
      'body' => $body
   ]);
}
