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
    
    public static function tutkijanToiminta() {
        View::make('suunnitelmat/tutkijan_toiminta.html');
    }
    
    public static function kohteenEsittely() {
        View::make('suunnitelmat/kohteen_esittely.html');
    }
    
    public static function tutkimuksenEsittely() {
        View::make('suunnitelmat/tutkimuksen_esittely.html');
    }
        
    public static function naytteenEsittely() {
        View::make('suunnitelmat/naytteen_esittely.html');
    }
    
    public static function kohteenMuokkaus(){
        View::make('suunnitelmat/kohteen_muokkaus.html');
    }
    
    public static function tutkimuksenMuokkaus() {
        View::make('suunnitelmat/tutkimuksen_muokkaus.html');
    }
    
    public static function naytteenMuokkaus() {
        View::make('suunnitelmat/naytteen_muokkaus.html');
    }
    
  }
