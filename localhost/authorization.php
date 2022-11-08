<?php

$err = [];

$db = mysqli_connect(
    "127.0.0.1",
    "user",
    "user",
    "Kursovaya"
);

session_start();
$pass='asdfnasdhfbauejnj32rn23nfoini1fn12f1';

if (isset($_POST['submit'])) {
    $query = mysqli_query($db, "SELECT `Login`, `Password` FROM `Authorization` WHERE `Login` ='" . mysqli_real_escape_string($db,$_POST['username']) . "' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if ($data == Null) {
        $err[] = "Неверный логин или пароль";
    }
    else if($data['Password'] === md5(md5($_POST['password'].$pass)))
    {
        $_SESSION['Logging'] = mysqli_real_escape_string($db, $data['Login']);
        setcookie("id", $data['id'], time()+60*60*24*30, "/");
        setcookie("username", $data['Login'], time()+60*60*24*30, "/");
        header("Location: index.php"); exit;
    } 
    else
    {
        $err[] = "Неверный логин или пароль";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Авторизация</title>
</head>
<body><br>
    <div class="container text-center">             
    <div style="font-size: xx-large;">Авторизация пользователя</div>
    <form method="POST" action="#">
    <br>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Логин</span>
            <input name="username" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Пароль</span>
            <input name="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2">
        </div>
        <?php foreach($err AS $error){ print $error."<br>"; } ?>
        <div style="margin-left: 75px;">Нет аккаунта?<br></div>        
        <button name="submit" class="btn btn-primary btn-lg">Войти в аккаунт</button> 
        <a class="btn btn-light btn-lg" href="registration.php">Зарегистрироваться</a>
    <br><br>
    <a href="index.php" class="btn btn-outline-secondary btn-lg" id="pills-contact-tab" type="button">Главная</a>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
</body>
</html>