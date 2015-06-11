<?php
//Homepage and user stuff:
  $routes->get('/', function() {
    HomeController::index();
  });

  $routes->post('/login', function(){
    HomeController::login();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

//chores
 $routes->get('/chores', function() {
    ChoreController::index();
  });
 $routes->get('/chores/', function() {
    ChoreController::index();
  });




 $routes->get('/chore/:id', function($id) {
    ChoreController::view($id);
  });

 $routes->post('/chores/new', function() {
    ChoreController::store();
  });

 $routes->get('/chores/:id/edit', function($id) {
	ChoreController::edit($id);
  });

 $routes->post('/chores/:id/edit', function($id) {
	ChoreController::update($id);
  });

 $routes->post('/chores/:id/destroy', function($id) {
	ChoreController::destroy($id);
  });






  
