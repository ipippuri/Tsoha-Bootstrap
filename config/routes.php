<?php

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  
  
  $routes->get('/', function() {
    KayttajaController::login();
  });
  
  $routes->post('/', function() {
    KayttajaController::handle_login();
  });
  
  $routes->post('/logout', function() {
    KayttajaController::logout();
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
  
  $routes->get('/kohde/:kohdeid/edit', function($kohdeid) {
    KohdeController::edit($kohdeid);
  });
  
  $routes->post('/kohde/:kohdeid/edit', function($kohdeid) {
    KohdeController::update($kohdeid);
  });
  
  $routes->post('/kohde/:kohdeid/destroy', function($kohdeid) {
    KohdeController::destroy($kohdeid);
  });

  
  
  
  $routes->get('/tutkimus', function() {
    TutkimusController::index();
  });
  
  $routes->post('/kohde/:kohdeid', function($kohdeid) {
    TutkimusController::store($kohdeid);
  });
  
  $routes->get('/kohde/:kohdeid/new', function($kohdeid) {
    TutkimusController::create($kohdeid);
  });
  
  $routes->get('/tutkimus/:tutkimusid', function($tutkimusid) {
    TutkimusController::show($tutkimusid);
  });
  
  $routes->get('/tutkimus/:tutkimusid/edit', function($tutkimusid) {
    TutkimusController::edit($tutkimusid);
  });
  
  $routes->post('/tutkimus/:tutkimusid/edit', function($tutkimusid) {
    TutkimusController::update($tutkimusid);
  });
  
  $routes->post('/tutkimus/:tutkimusid/destroy', function($tutkimusid) {
    TutkimusController::destroy($tutkimusid);
  });

  
  

  
  $routes->post('/tutkimus/:tutkimusid', function($tutkimusid) {
    NayteController::store($tutkimusid);
  });
  
  $routes->get('/tutkimus/:tutkimusid/new', function($tutkimusid) {
    NayteController::create($tutkimusid);
  });
  
  $routes->get('/tutkimus/:tutkimusid/:nayteid/edit', function($tutkimusid, $nayteid) {
    NayteController::edit($tutkimusid, $nayteid);
  });
  
  $routes->post('/tutkimus/:tutkimusid/:nayteid/edit', function($tutkimusid, $nayteid) {
    NayteController::update($tutkimusid, $nayteid);
  });
  
  $routes->get('/tutkimus/:tutkimusid/:nayteid', function($tutkimusid, $nayteid) {
    NayteController::show($tutkimusid, $nayteid);
  });
  
  $routes->post('/tutkimus/:tutkimusid/:nayteid/destroy', function($tutkimusid, $nayteid) {
    NayteController::destroy($tutkimusid, $nayteid);
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