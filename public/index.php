<?php
session_start();

use app\library\Authenticate;
use app\library\GoogleCliente;

require '../vendor/autoload.php';

$googleClient = new GoogleCliente;
$googleClient->init();

if($googleClient->authorized()){
    $auth = new Authenticate;
    $auth->authGoogle($googleClient->getData());
}

$authUrl = $googleClient->generateAuthLink();

if(isset($_GET['code'])){
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Olá, </h2>
    <?php
    if(isset($_SESSION['user'], $_SESSION['auth'])): 
        echo $_SESSION['user']->firstName
    ?>

    <?php else: ?>
        Visitante
    <?php endif; ?>
    

    <form>
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="Login">
        <a href="<?=$authUrl;?>">Login Google</a>

    </form>
    
</body>
</html>