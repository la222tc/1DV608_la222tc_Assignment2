<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('model/Login.php');
require_once('model/ListOfUsers.php');

require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_set_cookie_params(0);
$listOfUsers = new model\ListOfUsers();

$login = new \model\Login($listOfUsers);


//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($login);
$dtv = new DateTimeView();
$lv = new LayoutView();


$lc = new LoginController($v, $login);

$lc->tryToLogin();

$lv->render($login->isLoggedIn(), $v, $dtv);

