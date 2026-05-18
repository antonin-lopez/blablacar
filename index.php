<?php
session_start();
$_SESSION['login_id'] = -1;
$_SESSION['nom'] = "";
$_SESSION['prenom'] = "";
$_SESSION['role'] = "";
$_SESSION['solde'] = 0;
header('Location: app/router/router.php?action=truc');
exit();
?>