
<?php

include 'start.php';
$github = new Github('emre');
$repos = $github->getUserRepos();
$userInfo = $github->getUserInfo();
//print_r($userInfo);
include 'inc/main.php';
?>
