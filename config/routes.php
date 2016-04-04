<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
  });
  
  $routes->get('/kohteidenlistaus', function() {
    HelloWorldController::kohteidenListaus();
  });
  
  $routes->get('/tutkimustenlistaus', function() {
  HelloWorldController::tutkimustenListaus();
  });
  
  $routes->get('/tutkijantoiminta', function() {
    HelloWorldController::tutkijanToiminta();
  });
  
  $routes->get('/kohteenesittely', function() {
    HelloWorldController::kohteenEsittely();
  });
  
  $routes->get('/tutkimuksenesittely', function() {
      HelloWorldController::tutkimuksenEsittely();
  });
    
  $routes->get('/naytteenesittely', function() {
    HelloWorldController::naytteenEsittely();
  });
  
  $routes->get('/kohteenmuokkaus', function() {
    HelloWorldController::kohteenMuokkaus();
  });
  
  $routes->get('/tutkimuksenmuokkaus', function() {
    HelloWorldController::tutkimuksenMuokkaus();
  });
    
  $routes->get('/naytteenmuokkaus', function() {
    HelloWorldController::naytteenMuokkaus();
  });
  
