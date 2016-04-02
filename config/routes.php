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
  
    $routes->get('/kohteenhistoria', function() {
  HelloWorldController::kohteenHistoria();
  });
  
  $routes->get('/tutkijantoiminta', function() {
    HelloWorldController::tutkijanToiminta();
  });
  
  $routes->get('/kohteenesittely', function() {
    HelloWorldController::kohteenEsittely();
  });
  
  $routes->get('/naytteenesittely', function() {
  HelloWorldController::naytteenEsittely();
  });
