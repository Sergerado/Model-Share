<?php

$db = mysqli_connect(
    "127.0.0.1",
    "user",
    "user",
    "Kursovaya"
);

$RightManaged = "Скачивание и просмотр модели разрешены только в образовательных целях. Публикация разрешена только с указанием автора. Модификация и использование (в любых целях) запрещены.";
$Royaltyfree = "Разрешено использовать модель для собственных проектов и образовательных целей, модифицировать и публиковать с указанием автора. Запрещено использовать только в коммерческих целях";
$PublicDomain = "Модель находится в полном доступе без каких-либо ограничений. Разрешены модификация, публикация без указания автора и использование в любых проектах, в том числе коммерческих.";

session_start();

    $query = mysqli_query($db, "SELECT * FROM `work` WHERE `id` ='" . $_GET['id'] . "'");
    $data = mysqli_fetch_assoc($query);

    $modelname = $data['modelname'];
    $license = $data['license'];
    $modelfile = $data['modelfile'];
    $tags = $data['tags'];
    $modeldescription = $data['description'];
    $properties = $data['properties'];
    $creator = $data['Creator'];
    $create = $data['datecreate'];

    
    if ($license === "Public Domain") $licensetext = $PublicDomain ."\n- Можно модифицировать\n- Можно перепубликовать, даже без автора\n- Можно использовать в своих работах\n- Можно использовать в коммерции";
    if ($license === "Right Managed") $licensetext = $RightManaged . "\n- Нельзя модифицировать\n- Можно перепубликовать, указав автора\n- Нельзя использовать в своих работах\n- Нельзя использовать в коммерции";
    if ($license === "Royalty-free") $licensetext = $Royaltyfree . "\n- Можно модифицировать\n- Можно перепубликовать, указав автора\n- Можно использовать в своих проектах\n- Нельзя использовать в коммерции";

    if($data['isdelete'] == 0) $text = '<input name="delete" type="submit" class="btn btn-outline-danger btn-lg" value="Удалить" onclick="proverka()"></input>';
        else $text = '<input name="reestablish" type="submit" class="btn btn-outline-info btn-lg" value="Восстановить" onclick="proverka()"></input>';


    if(isset($_POST['delete'])) {
        mysqli_query($db, "UPDATE `work` SET `isdelete` = '1' WHERE `id` = '" . $_GET['id'] . "'");
        header("Location: index.php");
    }
    if(isset($_POST['reestablish'])) {
        mysqli_query($db, "UPDATE `work` SET `isdelete` = '0' WHERE `id` = '" . $_GET['id'] . "'");
        header("Location: index.php");
    }

    if($data['isdelete'] == '1') {
        if($data['Creator'] == $_COOKIE['username'] or $_COOKIE['username'] == "SkyFall"){
            
        } else {
            header("Location: index.php");
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
    <title>Просмотр модели</title>
</head>
<body>      
    <br>
    <div class="container" id="modelname" style="font-size: 24px;"><?php echo $modelname ?></div>
    <div class="container text-center">  
        <div class="row">
            <div class="col-md-7">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php 
                    
                    $temp = 0;
                    $dir = "works/" . $_GET['id'];
                    $files = scandir($dir, 1);
                    foreach ($files as $file) {
                        if(preg_match('/\.(jpg|jpeg|png|bmp)$/', $file))    {
                            if ($temp == 0) {
                                $temp++;
                                echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 0"></button>';
                            } else {
                                echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $temp . '" aria-label="Slide ' . $temp . '"></button>';
                                $temp++;
                            }
                        }
                    }
                    ?>
                </div>
                    <div class="carousel-inner">
                        <?php     
                        $temp = 1;
                        $dir = "works/" . $_GET['id'];
                        $files = scandir($dir, 1);
                        foreach ($files as $file) {
                            if(preg_match('/\.(jpg|jpeg|png|bmp)$/', $file))    
                                    if ($temp == 1) {
                                        $temp++;
                                        echo '
                                        <div class="carousel-item active" data-bs-interval="10000">
                                            <img src="' . $dir . "/" . $file . '" class="d-block w-100" alt="..." style="height: 500px;">
                                        </div>';
                                    } else 
                                    echo '
                                    <div class="carousel-item" data-bs-interval="10000">
                                        <img src="' . $dir . "/" . $file . '" class="d-block w-100" alt="..." style="height: 500px;">
                                    </div>';
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-sm" style="font-size: 24px;">
                <form method="POST">                    
                    <a href="<?php echo  $dir . "/model/" . $modelfile; ?>" type="button" class="btn btn-outline-success btn-lg" download>Скачать</a>
                    <?php if(isset($_COOKIE['username'])) {if ($data['Creator'] == $_COOKIE['username'] or $_COOKIE['username'] == "SkyFall") echo $text; }?>
                </form>
                <div>Лицензия</div>
                <textarea disabled id="license" class="form-control" aria-label="With textarea" style="height: 341px; max-height: 341px;" ><?php echo $licensetext ?></textarea>
                <div>Автор</div>
                <input disabled type="text" class="form-control text-center" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="<?php echo $creator ?>">
            </div>
        </div>
        <div class="row" style="font-size: 24px;">
            <div class="col-sm-3">
                Свойства
                <textarea disabled id="properties" class="form-control" aria-label="With textarea" style="height: 300px;"><?php echo $properties ?></textarea>
            </div>
            <div class="col-sm-4">
                Описание
                <textarea disabled id="description" class="form-control" aria-label="With textarea" style="height: 300px;"><?php echo $modeldescription ?></textarea>
            </div>
            <div class="col-sm">
                Тэги
                <textarea disabled id="tags" class="form-control" aria-label="With textarea" style="height: 224px;"><?php echo $tags ?></textarea>
                Загружено
                <input disabled type="text" class="form-control text-center" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="dateupload" value="<?php echo $create ?>">
            </div>
        </div>
        <br>
        <a href="./"><button type="button" class="btn btn-outline-primary btn-lg">Назад</button><br></a><br><br>
    </div>
    <script>
        function proverka() {
            if (confirm("Подтвердить")) {
                return true;
            } else {
                    return false;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
</body>
</html>