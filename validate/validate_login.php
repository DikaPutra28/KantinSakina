<?php
$username = (isset($_POST["username"])) ? htmlentities($_POST["username"]) : "";
$password = (isset($_POST["password"])) ? htmlentities($_POST["password"]) : "";
if (!empty($_POST['submit_validate'])) {
      header('location:../home');
}
?>