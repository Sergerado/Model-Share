<?php
session_start();

setcookie("id", $data['id'], time()-60*60*24*30, "/");
setcookie("username", $data['Login'], time()-60*60*24*30, "/");

session_unset();
unset($_SESSION['Logging']);
session_destroy();
setcookie(session_name(), session_id(), time()-3600);

header("Location: authorization.php"); exit;

?>