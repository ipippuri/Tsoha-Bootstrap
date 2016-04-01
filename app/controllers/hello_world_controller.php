<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';
    }
    
    public static function etusivu() {
        View::make('suunnitelmat/etusivu.html');
    }
    
    public static function kohteidenListaus() {
        View::make('suunnitelmat/kohteiden_listaus.html');
    }
    
    public static function kohteenHistoria() {
        View::make('suunnitelmat/kohteen_historia.html');
    }
    
    public static function tutkijanToiminta() {
        View::make('suunnitelmat/tutkijan_toiminta.html');
    }
    
    public static function kohteenEsittely() {
        View::make('suunnitelmat/kohteen_esittely.html');
    }
  }
