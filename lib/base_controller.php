<?php

  class BaseController{

    public static function get_user_logged_in(){

    if(isset($_SESSION['user'])){
		Kint::dump($_SESSION);
		
      $user_id = $_SESSION['user'];
      $user = Useeer::find($user_id);
      Kint::dump($user);
      return $user;
    }

    // Käyttäjä ei ole kirjautunut sisään
    return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
