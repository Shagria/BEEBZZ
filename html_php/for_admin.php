<?php 
require './UsersDatabase.php';
$usersDatabase = new UsersDatabase();
if(isset($_COOKIE['email'])){
    $email = $_COOKIE['email'];
    $users = $usersDatabase->getUSer($email);
    foreach($users as $user){
        $admin = $user['admin'];
    }
    if($admin == 1){
        header("Location: orders.php");
    }else{
        header("Location: index.php");
    }
}else{
    header('Location: index.php');
}
