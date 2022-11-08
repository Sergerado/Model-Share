<?php

$err = [];

$db = mysqli_connect(
    "127.0.0.1",
    "user",
    "user",
    "Kursovaya"
);

$pass='asdfnasdhfbauejnj32rn23nfoini1fn12f1';

function can_upload($file){
	// если имя пустое, значит файл не выбран
    if($file['name'] == '')
		return 'Вы не выбрали файл.';
	
	/* если размер файла 0, значит его не пропустили настройки 
	сервера из-за того, что он слишком большой */
	if($file['size'] == 0)
		return 'Файл слишком большой.';
	
	// разбиваем имя файла по точке и получаем массив
	$getMime = explode('.', $file['name']);
	// нас интересует последний элемент массива - расширение
	$mime = strtolower(end($getMime));
	// объявим массив допустимых расширений
	$types = array('jpg', 'png', 'bmp', 'jpeg');
	
	// если расширение не входит в список допустимых - return
	if(!in_array($mime, $types))
		return 'Недопустимый тип файла.';
	
	return true;
}

session_start();

if (isset($_SESSION['Logging'])) {
    
    $query = mysqli_query($db,"SELECT `img` FROM `Authorization` WHERE `Login` = '" . $_COOKIE['username'] . "'"); 
    $data = mysqli_fetch_assoc($query);
    $img = $data['img'];
}
else {
    header("Location: index.php"); exit;
}

if (isset($_POST['submit'])) {        
    $i = 0;

    $query = mysqli_query($db,"SELECT * FROM `Authorization` WHERE `Login` = '" . $_COOKIE['username'] . "'");
    $data = mysqli_fetch_assoc($query);

    // проверяем, можно ли загружать изображение        
    $check = can_upload($_FILES['avatarload']);
    if ($data['Password'] != md5(md5($_POST['oldpassword'].$pass)))
        $err[] = "Некорректный старый пароль";

    if ($_POST['newpassword'] == "")
        $i++;
    if ($_POST['email'] == "")
        $i++;
    if ($check === 'Вы не выбрали файл.') 
        $i++;
    
    if ($i == 3) 
        $err[] = "Все поля пустые!";
	
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
		$err[] = "E-mail адрес указан неверно";

    if ($_POST['newpassword'] != "") {
        if (strlen($_POST['newpassword']) < 7)
        $err[] = "Пароль должен содержать минимум 7-мь символов";
    if (count($err) == 0)
        $password = md5(md5(trim($_POST['newpassword'].$pass)));
    }
    else {
        $password = $data['Password'];        
    }
    
    
    if (count($err) == 0) {
        if($check === true or $check == 'Вы не выбрали файл.'){
          // загружаем изображение на сервер и удаляем старое
        if($check === true) {
            $name = mt_rand(0, 10000) . $_FILES['avatarload']['name'];
            copy($_FILES['avatarload']['tmp_name'], 'avatars/' . $name);
            unlink("avatars/" . $data['img']);
        }
        else {
            $name = $data['img'];
        }
        if ($_POST['email'] != "") {            
            $email = $_POST['email'];
        }
        else {            
            $email = $data['Email'];
        }

        mysqli_query($db, "UPDATE `Authorization` SET `Password` = '" . $password . "', `Email` = '" . $email . "', `img` = '" . $name . "' WHERE `Login` = '" . $_COOKIE['username'] . "'");
        
        $err[] = "Данные успешно изменены!";
    }
        else {
            // выводим сообщение об ошибке
            $err[] = $check;
        }                        
    }
}0



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Изменить Данные</title>
</head>
<body>
    <div class="container text-center">
        <br>
        <p style="font-size: xx-large">Изменение данных</p>
        <form method="POST" action="#" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Пароль</span>
                <input name="oldpassword" type="password" class="form-control" placeholder="Old Password" aria-label="Username" aria-describedby="basic-addon1">
                <span class="input-group-text" id="basic-addon2">Новый пароль</span>
                <input name="newpassword" type="password" class="form-control" placeholder="Password" aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Почта</span>
                <input name="email" type="text" class="form-control" placeholder="E-mail" aria-label="email" aria-describedby="basic-addon1">
                <input type="file" class="form-control" id="avatarload" name="avatarload" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <span class="input-group-text" id="basic-addon1">Аватар</span>
                <button class="btn btn-outline-secondary" type="button" id="clearload">Очистить</button>
            </div>
            
            <a class="btn btn-light btn-lg" href="index.php">Назад</a>
            <input name="submit" type="submit" href="" class="btn btn-primary btn-lg" id="pills-contact-tab" value="Обновить"/>
        </form>
        <?php foreach($err AS $error){ print $error."<br>"; } ?>  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
</body>
</html>