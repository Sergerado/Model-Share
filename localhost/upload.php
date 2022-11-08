<?php

$err = [];

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

if (!isset($_SESSION['Logging'])) {
    header("Location: index.php"); exit;
}

if(isset($_POST['submit'])) {
    
    $total_files = count($_FILES['addimage']['name']);
    $query = mysqli_query($db,"SELECT max(id) + 1 as count FROM `work`"); 
    $data = mysqli_fetch_assoc($query);
    


    if($_POST['modelname'] != "") {
        $modelname = $_POST['modelname'];        
        $query = mysqli_query($db,"SELECT `modelname` FROM `work` WHERE `modelname` = '" . $modelname . "'");
        if (mysqli_num_rows($query) > 0)
            $err[] = "Моделька с таким названием уже существует.";
    } else {
        $err[] = "Вы не ввели название модели.";
    }
    if($_POST['discriptionmodel'] != "") {
        $modeldescription = $_POST['discriptionmodel'];
    } else {
        $err[] = "Вы не ввели описание модели.";
    }
    if($_POST['tags'] != "") {
        $tags = $_POST['tags'];
    } else {
        $err[] = "Вы не выбрали теги.";
    }
    if($_POST['licenseselect'] != "") {
        if ($_POST['licenseselect'] === $RightManaged)
            $license = "Right Managed";
        if ($_POST['licenseselect'] === $Royaltyfree)
            $license = "Royalty-free";
        if ($_POST['licenseselect'] === $PublicDomain)
            $license = "Public Domain";
    } else {
        $err[] = "Не выбрана лицензия.";
    }
    $properties = "";
    if(isset($_POST['checkbox'])) {
        for ($i = 0; $i < count($_POST['checkbox']); $i++) {
            $properties = $properties . $_POST['checkbox'][$i] . "\n";
        }
    } else {
        $err[] = "Не выбраны свойства модели.";
    }

    if($_FILES['addmodel']['name'] == "") {
        $err[] = "Вы не выбрали файл модельки.";
    }
    else if($_FILES['addmodel']['size'] == 0) {
        $err[] = "Файл модельки слишком большой.";
    }

    if(!file_exists("works/" . $data['count'])) {        
        mkdir("works/" . $data['count'], 0077, true);   
        mkdir("works/" . $data['count'] . "/model", 007, true);     
    }

    if (count($err) == 0) {      
    $dir = "works/". $data['count'] . "/";
    $ext = strtolower(pathinfo($_FILES["addmodel"]["name"], PATHINFO_EXTENSION));
        if (in_array($ext, array('7z', 'zip', 'rar'))) {
            $modelfile = $_FILES['addmodel']['name'];
            $original_filename = $_FILES['addmodel']['name'];
            $target = $dir . "model/" . $original_filename;
            $tmp = $_FILES['addmodel']['tmp_name'];
            move_uploaded_file($tmp, $target);
        } else {
            $err[] = "Неверный формат модели файла.";
        }
    }

    if (count($err) == 0) {
        for ($i = 0; $i < $total_files; $i++) {
            if(isset($_FILES['addimage']['name'][$i]) && $_FILES['addimage']['size'][$i] > 0) {
                $ext = strtolower(pathinfo($_FILES["addimage"]["name"][$i], PATHINFO_EXTENSION));
                if( in_array($ext, array('jpg', 'jpeg', 'png', 'bmp'))) {
                    if ($i == 0) {
                        $preview_img = $_FILES['addimage']['name'][0];
                    }
                    $original_filename = $_FILES['addimage']['name'][$i];
                    $target = $dir . $original_filename;
                    $tmp = $_FILES['addimage']['tmp_name'][$i];
                    move_uploaded_file($tmp, $target);
                } else {
                    $err[] = "Неверный формат модели файла.";
                }
            }
            else {
                $err[] = "Загрузите хотя бы одну картинку.";
            }
        }
    }
    if (count($err) == 0) {
        mysqli_query($db, "INSERT INTO `work`(`modelname`, `modelfile`, `description`, `tags`, `license`, `properties`, `preview_img`, `Creator`, `datecreate`) VALUES ('" . $modelname . "', '" . $modelfile . "', '" . $modeldescription . "', '" . $tags . "', '" . $license . "', '" . $properties . "', '" . $preview_img . "', '" . $_COOKIE['username'] . "', '" . date('Y-m-d H:i:s')  . "')");  
        header("Location: view.php?id=". $data['count']);
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
    <title>Загрузка модели</title>
    <style>
        img {
            height: 256px;
            order: 1;
        }
        label {
            cursor: pointer;
            background-color: #ced4da;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px ridge black;
            font-size: 0.8rem;
            height: auto;
        }        
        label:hover {
        background-color: #0d6efd;
        color: white;
        }

        label:active {
        background-color: #0D3F8F;
        color: white;
        }
    </style>
</head>
<body>
    <div class="container text-center" style="font-size: 24px;">        
        <br>
    <form method="POST" action="#" enctype="multipart/form-data">
        <p>Изображения   
        <div>
    <div style="font-size: 16px;" class="im"></div>        
    <label style="margin: 5px;font-size: 16px;" for="addimage">Выберите изображения</label>
    <input style="display: none;" id="addimage" type="file" name="addimage[]" multiple accept=".png,.jpg,.jpeg">
        <br>
        <div class="row">
            <div class="col-sm-5">
            <div class="input-group mb-3">
                    <span class="input-group-text" id="modelname">Название модели</span>
                    <input id="modelname" name="modelname" placeholder="Название модели" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="modelname">
                </div>
            </div>
            <div class="col-sm">
                <div class="input-group">
                    <span class="input-group-text">Файл модельки</span>
                    <input type="file" class="form-control" id="addmodel" name="addmodel" aria-describedby="addmodel" aria-label="Upload" multiple accept=".rar,.zip,.7z">         
                    <button class="btn btn-outline-secondary" type="button" id="clearload">Очистить</button>          
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <select id="selecttags" class="form-select" onchange="document.getElementById('tags').value += this.options[this.selectedIndex].value + ' '">
                    <option selected value="">Добавить теги</option>
                    <option value="#3dprint">3dprint</option>                    
                    <option value="#3dsmax">3dsmax</option>
                    <option value="#aircraft">aircraft</option>
                    <option value="#animals">animals</option>
                    <option value="#animated">animated</option>
                    <option value="#architectural">architectural</option>
                    <option value="#blender3d">blender3d</option>
                    <option value="#car">car</option>
                    <option value="#cgi">cgi</option>
                    <option value="#character">character</option>
                    <option value="#cinema4d">cinema4d</option>
                    <option value="#corona">corona</option>
                    <option value="#cycles">cycles</option>
                    <option value="#eevee">eevee</option>
                    <option value="#exterior">exterior</option>
                    <option value="#food">food</option>
                    <option value="#furniture">furniture</option>
                    <option value="#gameready">gameready</option>
                    <option value="#highpoly">highpoly</option>
                    <option value="#household">household</option>
                    <option value="#industrial">industrial</option>
                    <option value="#interior">interior</option>
                    <option value="#lowpoly">lowpoly</option>
                    <option value="#materials">materials</option>
                    <option value="#midpoly">midpoly</option>
                    <option value="#military">military</option>
                    <option value="#prop">prop</option>
                    <option value="#plant">plant</option>
                    <option value="#public">public</option>
                    <option value="#public-domain">public-domain</option>
                    <option value="#realistic">realistic</option>
                    <option value="#rights-managed">rights-managed</option>
                    <option value="#royalty-free">royalty-free</option>
                    <option value="#scene">scene</option>
                    <option value="#space">space</option>
                    <option value="#textured">textured</option>
                    <option value="#uv">uv</option>
                    <option value="#vehicle">vehicle</option>
                    <option value="#vray">vray</option>
                    <option value="#watercraft">watercraft</option>                    
                </select>
                <br>
                <div class="input-group">                    
                    <button class="btn btn-outline-secondary" type="button" id="cleartags">Очистить</button>          
                    <textarea id="tags" name="tags" class="form-control" readonly></textarea>
                </div>
            </div>
            <div class="col-sm">
                <div class="input-group">
                    <span class="input-group-text">Описание модели</span>
                    <textarea id="discriptionmodel" name="discriptionmodel" style="height: 150px;" class="form-control" aria-label="With textarea"></textarea>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-5">
                <select name="licenseselect" id="selectlicense" class="form-select" aria-label="Default select example" onchange="document.getElementById('Textlicense').value = this.options[this.selectedIndex].value">
                    <option selected value="">Выберите лицензию</option>
                    <option value="Скачивание и просмотр модели разрешены только в образовательных целях. Публикация разрешена только с указанием автора. Модификация и использование (в любых целях) запрещены.">Right Managed</option>
                    <option value="Разрешено использовать модель для собственных проектов и образовательных целей, модифицировать и публиковать с указанием автора. Запрещено использовать только в коммерческих целях">Royalty-free</option>
                    <option value="Модель находится в полном доступе без каких-либо ограничений. Разрешены модификация, публикация без указания автора и использование в любых проектах, в том числе коммерческих.">Public Domain</option>
                </select><br>
                <textarea style="height: 164px;" readonly id="Textlicense" class="form-control" aria-label="With textarea"></textarea>
            </div>
            <div class="col-sm">
                Свойства
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input name="checkbox[]" class="form-check-input mt-0" type="checkbox" value="UV-развёртка" aria-label="Checkbox for following text input">
                    </div>
                    <input disabled type="text" class="form-control" aria-label="Text input with checkbox" value="UV-развёртка">
                    <div class="input-group-text">
                        <input name="checkbox[]" class="form-check-input mt-0" type="checkbox" value="Риггинг" aria-label="Checkbox for following text input">
                    </div>
                    <input disabled type="text" class="form-control" aria-label="Text input with checkbox" value="Риггинг">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input name="checkbox[]" class="form-check-input mt-0" type="checkbox" value="Материалы" aria-label="Checkbox for following text input">
                    </div>
                    <input disabled type="text" class="form-control" aria-label="Text input with checkbox" value="Материалы">
                    <div class="input-group-text">
                        <input name="checkbox[]" class="form-check-input mt-0" type="checkbox" value="Анимации" aria-label="Checkbox for following text input">
                    </div>
                    <input disabled type="text" class="form-control" aria-label="Text input with checkbox" value="Анимации">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input name="checkbox[]" class="form-check-input mt-0" type="checkbox" value="Текстуры" aria-label="Checkbox for following text input">
                    </div>
                    <input disabled type="text" class="form-control" aria-label="Text input with checkbox" value="Текстуры">
                    <div class="input-group-text">
                        <input name="checkbox[]" class="form-check-input mt-0" type="checkbox" value="Лоуполи (Game ready)" aria-label="Checkbox for following text input">
                    </div>
                    <input disabled type="text" class="form-control" aria-label="Text input with checkbox" value="Лоуполи (Game ready)">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input name="checkbox[]" class="form-check-input mt-0" type="checkbox" value="Аддоны" aria-label="Checkbox for following text input">
                    </div>
                    <input disabled type="text" class="form-control" aria-label="Text input with checkbox" value="Аддоны">
                    <div class="input-group-text">
                        <input name="checkbox[]" class="form-check-input mt-0" type="checkbox" value="PBR" aria-label="Checkbox for following text input">
                    </div>
                    <input disabled type="text" class="form-control" aria-label="Text input with checkbox" value="PBR">
                </div>                     
            </div>
        </div>  
            <div style="font-size: 18px;"><?php foreach($err AS $error){ print $error."<br>"; } ?></div>  
            <a href="./"><button type="button" class="btn btn-primary btn-lg">Назад</button></a>
            <input type="submit" name="submit" class="btn btn-outline-secondary btn-lg" value="Отправить">
    </form>
    <br><br>
    <script type="text/javascript">

        var input = document.querySelector('#addimage');
        var preview = document.querySelector('.im');
        input.addEventListener('change', updateImageDisplay);
        
        let control = document.querySelector("#addmodel"),
        clearBn = document.querySelector("#clearload");
        let tags = document.querySelector("#tags");
        cleartags = document.querySelector("#cleartags");

        // Событие по клику на кнопку
        clearBn.addEventListener("click", function(){
            control.value = '';
            let newControl = control.cloneNode( true )
            control.replaceWith( newControl );
            control = newControl;
        });

        cleartags.addEventListener("click", function(){
            tags.value = '';
            let newControl = tags.cloneNode( true )
            tags.replaceWith( newControl );
            tags = newControl;
        });

        function updateImageDisplay() {
            while(preview.firstChild) {
                preview.removeChild(preview.firstChild);
            }

            var curFiles = input.files;
            if(curFiles.length === 0) {
                var para = document.createElement('p');
                para.textContent = 'No files currently selected for upload';
                preview.appendChild(para);
            } else {
                var list = document.createElement('ol');
                preview.appendChild(list);
                for(var i = 0; i < curFiles.length; i++) {
                var listItem = document.createElement('li');
                var para = document.createElement('p');
                if(validFileType(curFiles[i])) {
                    para.textContent = 'File name ' + curFiles[i].name + ', file size ' + returnFileSize(curFiles[i].size) + '.';
                    var image = document.createElement('img');
                    image.src = window.URL.createObjectURL(curFiles[i]);

                    listItem.appendChild(image);
                    listItem.appendChild(para);

                } else {
                    para.textContent = 'File name ' + curFiles[i].name + ': Not a valid file type. Update your selection.';
                    listItem.appendChild(para);
                }

                list.appendChild(listItem);
                }
            }
        }

        var fileTypes = [
            'image/jpeg',
            'image/pjpeg',
            'image/png'
        ]

        function validFileType(file) {
        for(var i = 0; i < fileTypes.length; i++) {
            if(file.type === fileTypes[i]) {
            return true;
            }
        }

        return false;
        }

        function returnFileSize(number) {
            if(number < 1024) {
                return number + 'bytes';
            } else if(number > 1024 && number < 1048576) {
                return (number/1024).toFixed(1) + 'KB';
            } else if(number > 1048576) {
                return (number/1048576).toFixed(1) + 'MB';
            }
        }

    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> 
    
</body>
</html>