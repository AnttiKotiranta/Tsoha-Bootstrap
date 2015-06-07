<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }
 public static function suunnitelmat_index(){
   	  View::make('suunnitelmat/homepage.html');
    }
    public static function chore_list(){
   	  View::make('suunnitelmat/muistilista.html');
    }
   public static function chore_edit(){
   	  View::make('suunnitelmat/edit.html');
    }
	

   public static function sandbox(){
       $chore = new Chore(array(
    'name' => 'asd',
    'priority' => '100',
    'deadline' => '2015/8/8',
    'description' => 'Boom, boom!'
  ));
  $errors = $chore->errors();
  Kint::dump($chore);
  Kint::dump($errors);
    }
  }
