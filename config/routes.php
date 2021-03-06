<?php
//Homepage and login/out:
  $routes->get('/', function() {
    HomeController::index();
  });

  $routes->post('/login', function(){
    HomeController::login();
  });

  $routes->post('/logout', function(){
    HomeController::logout();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

//chores
 $routes->get('/chores', 'check_logged_in', function() {
    ChoreController::index();
  });
 $routes->get('/chores/', 'check_logged_in', function() {
    ChoreController::index();
  });

 $routes->get('/chores/:id/edit', 'check_logged_in', function($id) {
    ChoreController::edit($id);
  });

 $routes->post('/chores/new', 'check_logged_in', function() {
    ChoreController::store();
  });

 $routes->post('/chores/:id/edit', 'check_logged_in', function($id) {
    ChoreController::update($id);
  });

 $routes->post('/chores/:id/destroy', 'check_logged_in', function($id) {
    ChoreController::destroy($id);
  });


//labels
 $routes->get('/labels', 'check_logged_in', function() {
    LabelController::index();
  });
 $routes->get('/labels/', 'check_logged_in', function() {
    LabelController::index();
  });

 $routes->get('/labels/:id/view', 'check_logged_in', function($id) {
    LabelController::view($id);
  });

 $routes->post('/labels/new', 'check_logged_in', function() {
    LabelController::store();
  });

  $routes->post('/labels/:id/edit', 'check_logged_in', function($id) {
    LabelController::update($id);
  });

 $routes->post('/labels/:id/destroy', 'check_logged_in', function($id) {
    LabelController::destroy($id);
  });


function check_logged_in(){
  BaseController::check_logged_in();
}






  
