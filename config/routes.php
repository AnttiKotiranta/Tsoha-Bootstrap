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


  
