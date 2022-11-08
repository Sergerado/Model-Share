<?php

$db = mysqli_connect(
    "127.0.0.1",
    "user",
    "user",
    "Kursovaya"
);

session_start();

if (isset($_SESSION['Logging'])) {
    $textright = '<a href="logout.php" class="nav-link" id="pills-contact-tab" type="button">Выйти</a>';
    $textcenter = '<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Профиль</button>';
}
else {
    $textright = '<a href="authorization.php" class="nav-link" id="pills-contact-tab" type="button">Войти</a>';
    $textcenter = '<a href="registration.php" class="nav-link" id="pills-contact-tab" type="button">Зарегистрироваться</a>';
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
    <title>Главная</title>
</head>
    <body>
        <div class="container">
        <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Главная</button>
        </li>
        <li class="nav-item" role="presentation">
            <?php echo $textcenter ?>
        </li>
        <li class="nav-item" role="presentation">
            <?php echo $textright ?>
        </li>
        </ul>
            <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active text-center" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
				<?php include "templates/Works.php"?>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <?php include "templates/Account.php"?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
    </body>
</html>