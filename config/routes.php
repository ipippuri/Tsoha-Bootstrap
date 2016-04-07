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
  

  $routes->get('/kohde', function() {
    KohdeController::index();
  });
  
  $routes->post('/kohde', function() {
    KohdeController::store();      
  });
  
  $routes->get('/kohde/new', function() {
    KohdeController::create();
  });
  
  $routes->get('/kohde/:kohdeid', function($kohdeid) {
    KohdeController::show($kohdeid);
  });
  
