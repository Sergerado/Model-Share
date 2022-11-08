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

if(isset($_POST['submit'])) {

    if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['username'])) 
        $err[] = "Логин может состоять только из букв английского алфавита и цирф";
    if (strlen($_POST['username']) < 3 or strlen($_POST['username']) > 15)
        $err[] = "Логин может содержать от 3-х до 15-ти символов";
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
		$err[] = "E-mail адрес указан неверно";
    if (strlen($_POST['password'] ) < 7)
        $err[] = "Пароль должен содержать минимум 7-мь символов";

    $query = mysqli_query($db, "SELECT `Login` FROM `Authorization` WHERE `Login` ='" . mysqli_real_escape_string($db, $_POST['username']) . "'");
    if (mysqli_num_rows($query) > 0)
        $err[] = "Пользователь с таким именем уже существует";
    if (count($err) == 0) {
            // проверяем, можно ли загружать изображение
            $check = can_upload($_FILES['avatarload']);
        

            if($check === true or $check == 'Вы не выбрали файл.'){
              // загружаем изображение на сервер
                if($check === true) {
                    $name = mt_rand(0, 10000) . $_FILES['avatarload']['name'];
                    copy($_FILES['avatarload']['tmp_name'], 'avatars/' . $name);
                }
                else {
                    $name = "no-avatar.png";
                }

                $login = $_POST['username'];
                $password = md5(md5(trim($_POST['password'].$pass)));

                mysqli_query($db, "INSERT INTO `Authorization`(`Login`, `Password`, `Email`, `img`) VALUES ('" . $login . "', '" . $password . "', '" . $_POST['email'] . "','" . $name . "')");

                header("Location: authorization.php"); exit;
            }
            else{
              // выводим сообщение об ошибке
                $err[] = $check;
            }                        
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
    <title>Регистрация</title>
</head>
<body>
    <div class="container text-center">        
    <br>    
    <div style="font-size: xx-large;">Регистрация пользователя</div>
        <form method="POST" action="#" enctype="multipart/form-data">
        <br>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Логин</span>
                <input name="username" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                <span class="input-group-text" id="basic-addon2">Пароль</span>
                <input name="password" type="password" class="form-control" placeholder="Password" aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Почта</span>
                <input name="email" type="text" class="form-control" placeholder="E-mail" aria-label="email" aria-describedby="basic-addon1">
                <input type="file" class="form-control" id="avatarload" name="avatarload" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <span class="input-group-text" id="basic-addon1">Аватар</span>
                <button class="btn btn-outline-secondary" type="button" id="clearload">Очистить</button>
            </div>

            <?php foreach($err AS $error){ print $error."<br>"; } ?>            
            <div style="margin-right: 255px;">Уже есть аккаунт?<br></div>   
            <a class="btn btn-light btn-lg" href="authorization.php">Войти в аккаунт</a>
            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Зарегистрироваться">
            <br><br>
            <a href="index.php" class="btn btn-outline-secondary btn-lg" id="pills-contact-tab" type="button">Главная</a>
        </form>
    </div>
    <script>
        
        let control = document.querySelector("#avatarload"),
        clearBn = document.querySelector("#clearload");

        clearBn.addEventListener("click", function(){
            control.value = '';
            let newControl = control.cloneNode( true )
            control.replaceWith( newControl );
            control = newControl;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
</body>
</html>