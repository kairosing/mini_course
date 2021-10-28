<?php

function get_user_by_email($email){
    $pdo = new PDO("mysql:host=mysql;dbname=get_fort","root","root");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email" => $email]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function login ($email, $password){
    $user = get_user_by_email($email);
    if (empty($user)) {
        set_flash_message('danger', 'такого пользователя не существует');
        return false;
    
    } else {
        $_SESSION['email'] = $user['email'];
        $_SESSION['admin'] = $user['admin'];
        $_SESSION['id'] = $user['id'];
        return true;
    }
}


function add_user($email, $password){
    $pdo = new PDO("mysql:host=mysql;dbname=get_fort","root","root");
    $sql = "INSERT INTO users(email,password) VALUES (:email, :password)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => $email, 'password' => $password]);
    return $pdo->lastInsertId();
}



function set_flash_message($name, $message){
    $_SESSION['name'] = $name;
    $_SESSION['message'] = $message;
}



function display_flash_message($name){
    if (isset($_SESSION['name'])) {
        echo "<div class=\"alert alert-{$_SESSION['name']} text-dark\" role=\"alert\">{$_SESSION['message']}</div>";
        unset($_SESSION['name']);
        unset($_SESSION['message']);
    }
}



function redirect_to($path){
    header("Location: {$path}");
    exit;

}
