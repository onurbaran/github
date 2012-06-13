<?php
include 'start.php';
$repoName = $_GET['rname'];
//Buraya xss ve injection için çeşitli önlemler kontroller gelebilir. 
$repoDetail = $github->getUserRepoCommits($repoName);
//print_r($repoDetail);
include 'inc/repoDetail.inc.php';
?>
