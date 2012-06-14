
<?php

include 'start.php';

$repos = $github->getUserRepos();
$userInfo = $github->getUserInfo();
//print_r($userInfo);
include 'inc/main.php';
?>
