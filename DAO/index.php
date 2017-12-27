<?php

require_once("config.php");

// $root = new Usuario();
// $root->loadById(1);
// echo $root;

// $lista = Usuario::getList();
// echo json_encode($lista);

// $search = Usuario::search("ia");
// echo json_encode($search);

$usuario = new Usuario();
$usuario->login("Nilo","12345");

echo $usuario;