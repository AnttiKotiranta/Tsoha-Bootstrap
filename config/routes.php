<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/suunnitelmat', function() {
    HelloWorldController::suunnitelmat_index();
  });
  $routes->get('/suunnitelmat/list', function() {
    HelloWorldController::chore_list();
  });
  $routes->get('/suunnitelmat/list/edit', function() {
    HelloWorldController::chore_edit();
  });

//chores
 $routes->get('/chore', function() {
    ChoreController::index();
  });

 $routes->get('/chore/:id', function($id) {
    ChoreController::view($id);
  });

 $routes->post('/chore', function() {
    ChoreController::store();
  });






  
