<?php 

$db = mysqli_connect(
    "127.0.0.1",
    "user",
    "user",
    "Kursovaya"
);

session_start();

if (isset($_SESSION['Logging'])) {
    
    $query = mysqli_query($db,"SELECT `img` FROM `Authorization` WHERE `Login` = '" . $_COOKIE['username'] . "'"); 
    $data = mysqli_fetch_assoc($query);
    $img = $data['img'];
}
else {
    header("Location: ../index.php"); exit;
}

?>


<div class="container d-flex flex-wrap justify-content-center user-back">
    <div id="left-column" class="d-flex flex-column user-content">
            <img class="mx-auto d-block img-fluid" src="<?php echo 'avatars/' . $img .'"'; ?>" alt="Аватарка" style=" width: 200px; height: 200px; border-radius: 8px; overflow: hidden;">
    </div>
    <div class="d-flex flex-column flex-fill user-content" style="font-size: 20px">
        <div id="user-name2" class="p-2" style="font-size: xx-large;"><?php if($_COOKIE['username'] == "SkyFall") { echo $_COOKIE['username'] . "<div style='color: red;'> ADMIN </div>";} else { echo $_COOKIE['username']; }?></div>

        <div style="margin: 5px;"><a href="change-accdata.php" class="btn btn-primary btn-md">Изменить данные</a></div>
        <div style="margin: 5px;"><a href="upload.php" class="btn btn-primary btn-md">Загрузить работу</a></div>
    </div>
</div>
<div class="container text-center">
    <?php 

        $query = mysqli_query($db,"SELECT * FROM `work` WHERE `Creator` = '" . $_COOKIE['username'] . "'"); 
        $workcount = mysqli_num_rows($query);
        if ($workcount > 0) {
            if ($_COOKIE['username'] == "SkyFall")  {                
                echo '<div style="font-size: xx-large;">Все работы</div>';
                $query = mysqli_query($db, "SELECT * FROM `work` WHERE `isdelete` = '0'");
                echo '
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Название модели</th>
                            <th scope="col">Тэги</th>
                            <th scope="col">Лицензия</th>
                            <th scope="col">Свойства</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col">Автор</th>
                        </tr>
                    </thead>
                    <tbody>
                ';      
                while($data = $query -> fetch_assoc()) {
                    echo '                
                    <tr style="cursor: pointer;" onclick="document.location = \'../view.php?id=' . $data['id'] . '\'">
                        <td>' . $data['id'] . '</td>
                        <td>' . $data['modelname'] . '</td>
                        <td width="250px">' . $data['tags'] . '</td>
                        <td>' . $data['license'] . '</td>
                        <td>' . $data['properties'] . '</td>
                        <td>' . $data['datecreate'] . '</td>
                        <td>' . $data['Creator'] . '</td>
                    </tr>';
                }
            } else {
            echo '<div style="font-size: xx-large;">Мои работы</div>';
            $query = mysqli_query($db, "SELECT * FROM `work` WHERE `Creator` = '" . $_COOKIE['username'] . "' and `isdelete` = '0'");
            echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название модели</th>
                        <th scope="col">Тэги</th>
                        <th scope="col">Лицензия</th>
                        <th scope="col">Свойства</th>
                        <th scope="col">Дата создания</th>
                    </tr>
                </thead>
                <tbody>
            ';      
            while($data = $query -> fetch_assoc()) {
                echo '                
                <tr style="cursor: pointer;" onclick="document.location = \'../view.php?id=' . $data['id'] . '\'">
                    <td>' . $data['id'] . '</td>
                    <td>' . $data['modelname'] . '</td>
                    <td width="250px">' . $data['tags'] . '</td>
                    <td>' . $data['license'] . '</td>
                    <td>' . $data['properties'] . '</td>
                    <td>' . $data['datecreate'] . '</td>
                </tr>';
            }
            }
            if ($_COOKIE['username'] == "SkyFall")  {
                $query = mysqli_query($db, "SELECT * FROM `work` WHERE `isdelete` = '1'");
                echo '</tbody>      
            </table>';
            echo '<div style="font-size: xx-large;">Удаленные работы</div>';
            echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название модели</th>
                        <th scope="col">Тэги</th>
                        <th scope="col">Лицензия</th>
                        <th scope="col">Свойства</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">Автор</th>
                    </tr>
                </thead>
                <tbody>
            ';
            while($data = $query -> fetch_assoc()) {
                echo '                
                <tr class="table-danger" style="cursor: pointer;" onclick="document.location = \'../view.php?id=' . $data['id'] . '\'">
                    <td>' . $data['id'] . '</td>
                    <td>' . $data['modelname'] . '</td>
                    <td width="250px">' . $data['tags'] . '</td>
                    <td>' . $data['license'] . '</td>
                    <td>' . $data['properties'] . '</td>
                    <td>' . $data['datecreate'] . '</td>
                    <td>' . $data['Creator'] . '</td>
                </tr>';
            }
            }
            else { 
            $query = mysqli_query($db, "SELECT * FROM `work` WHERE `Creator` = '" . $_COOKIE['username'] . "' and `isdelete` = '1'");
            echo '</tbody>      
            </table>';
            echo '<div style="font-size: xx-large;">Удаленные работы</div>';
            echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Название модели</th>
                        <th scope="col">Тэги</th>
                        <th scope="col">Лицензия</th>
                        <th scope="col">Свойства</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col">Автор</th>
                    </tr>
                </thead>
                <tbody>
            ';
            while($data = $query -> fetch_assoc()) {
                echo '                
                <tr class="table-danger" style="cursor: pointer;" onclick="document.location = \'../view.php?id=' . $data['id'] . '\'">
                    <td>' . $data['id'] . '</td>
                    <td>' . $data['modelname'] . '</td>
                    <td width="250px">' . $data['tags'] . '</td>
                    <td>' . $data['license'] . '</td>
                    <td>' . $data['properties'] . '</td>
                    <td>' . $data['datecreate'] . '</td>
                    <td>' . $data['Creator'] . '</td>
                </tr>';
            }
        }
            echo '</tbody>      
            </table>';
        }
    
    ?>
</div>
