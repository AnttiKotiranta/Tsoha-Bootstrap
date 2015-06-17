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
 	$s= LabelChores::find_by_chore_id(1);
	Kint::dump($s);
    }
  }
