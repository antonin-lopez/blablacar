<?php
session_start();
$_SESSION['prenom'] = "";
$_SESSION['nom'] = "";
$_SESSION['role'] = "";
$_SESSION['login_id'] = -1;
require 'app/router/router.php';
?>