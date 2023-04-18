<?php

require 'funciones.php';
require 'config/ddbb.php';
require __DIR__. '/../vendor/autoload.php';


// Conectar BBDD

$db = conexionDB();
use Model\ActiveRecord;
ActiveRecord::setDDBB($db);
