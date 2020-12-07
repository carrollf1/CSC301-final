<?php

//connect to mysql database
$user = 'carrollf1';
$password = 'a519ee75';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall20_carrollf1', $user, $password);

//start the session
session_start();

function my_autoloader($class) {
    include 'classes/class.' . $class . '.php';
}