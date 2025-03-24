<?php

if(!isset($_SESSION['user_id'])){
    header('Locaiton: index.php');
    exit();
}