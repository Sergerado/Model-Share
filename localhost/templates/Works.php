
            <div class='text-center' style="font-size: 20px;">Текущие фильтры: <?php if(isset($_GET['filters']) and $_GET['filters'] != "") echo $_GET['filters']; ?></div>

                <div id="filtersadd" style='display: none; margin-bottom: 5px;' class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <input value="3dprint" type="checkbox" class="btn-check" id="3dprint" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="3dprint">3dprint</label>

                    <input value="3dsmax" type="checkbox" class="btn-check" id="3dsmax" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="3dsmax">3dsmax</label>

                    <input value="aircraft" type="checkbox" class="btn-check" id="aircraft" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="aircraft">aircraft</label>       
                    
                    <input value="animals" type="checkbox" class="btn-check" id="animals" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="animals">animals</label>   
                    
                    <input value="animated" type="checkbox" class="btn-check" id="animated" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="animated">animated</label>    
                    
                    <input value="architectural" type="checkbox" class="btn-check" id="architectural" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="architectural">architectural</label>                           
                    
                    <input value="blender3d" type="checkbox" class="btn-check" id="blender3d" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="blender3d">blender3d</label>                           
                    
                    <input value="car" type="checkbox" class="btn-check" id="car" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="car">car</label>                           
                    
                    <input value="cgi" type="checkbox" class="btn-check" id="cgi" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="cgi">cgi</label>
                    
                    <input value="character" type="checkbox" class="btn-check" id="character" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="character">character</label>              
                    
                    <input value="cinema4d" type="checkbox" class="btn-check" id="cinema4d" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="cinema4d">cinema4d</label>                           
                    
                    <input value="corona" type="checkbox" class="btn-check" id="corona" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="corona">corona</label>             

                    <input value="cycles" type="checkbox" class="btn-check" id="cycles" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="cycles">cycles</label>              
                    
                    <input value="eevee" type="checkbox" class="btn-check" id="eevee" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="eevee">eevee</label>                           
                    
                    <input value="exterior" type="checkbox" class="btn-check" id="exterior" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="exterior">exterior</label>  

                    <input value="food" type="checkbox" class="btn-check" id="food" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="food">food</label>              
                    
                    <input value="furniture" type="checkbox" class="btn-check" id="furniture" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="furniture">furniture</label>                           
                    
                    <input value="gameready" type="checkbox" class="btn-check" id="gameready" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="gameready">gameready</label>  
                    
                    <input value="highpoly" type="checkbox" class="btn-check" id="highpoly" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="highpoly">highpoly</label>              
                    
                    <input value="household" type="checkbox" class="btn-check" id="household" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="household">household</label>                           
                    
                    <input value="industrial" type="checkbox" class="btn-check" id="industrial" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="industrial">industrial</label>             

                    <input value="interior" type="checkbox" class="btn-check" id="interior" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="interior">interior</label>              
                    
                    <input value="lowpoly" type="checkbox" class="btn-check" id="lowpoly" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="lowpoly">lowpoly</label>                           
                    
                    <input value="materials" type="checkbox" class="btn-check" id="materials" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="materials">materials</label>  

                    <input value="midpoly" type="checkbox" class="btn-check" id="midpoly" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="midpoly">midpoly</label>              
                    
                    <input value="military" type="checkbox" class="btn-check" id="military" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="military">military</label>                           
                    
                    <input value="prop" type="checkbox" class="btn-check" id="prop" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="prop">prop</label>                           
                    
                    <input value="plant" type="checkbox" class="btn-check" id="plant" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="plant">plant</label>  

                    <input value="public" type="checkbox" class="btn-check" id="public" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="public">public</label>                                      
                    
                    <input value="public-domain" type="checkbox" class="btn-check" id="public-domain" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="public-domain">public-domain</label> 

                    <input value="realistic" type="checkbox" class="btn-check" id="realistic" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="realistic">realistic</label>  

                    <input value="rights-managed" type="checkbox" class="btn-check" id="rights-managed" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="rights-managed">rights-managed</label>                           
                    
                    <input value="royalty-free" type="checkbox" class="btn-check" id="royalty-free" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="royalty-free">royalty-free</label>                           
                    
                    <input value="scene" type="checkbox" class="btn-check" id="scene" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="scene">scene</label>  

                    <input value="space" type="checkbox" class="btn-check" id="space" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="space">space</label>              
                    
                    <input value="textured" type="checkbox" class="btn-check" id="textured" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="textured">textured</label>                           
                    
                    <input value="uv" type="checkbox" class="btn-check" id="uv" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="uv">uv</label>                           
                    
                    <input value="vehicle" type="checkbox" class="btn-check" id="vehicle" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="vehicle">vehicle</label>  

                    <input value="vray" type="checkbox" class="btn-check" id="vray" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="vray">vray</label>                                      
                    
                    <input value="watercraft" type="checkbox" class="btn-check" id="watercraft" autocomplete="off">
                    <label style="margin-bottom: 10px;" class="btn btn-outline-primary" for="watercraft">watercraft</label> 

                </div>
                <div class="text-center">
                    <button id="filersbuttonopen" class="btn btn-outline-primary" style="margin-bottom: 10px; display: inline-block;" onclick="document.getElementById('filtersadd').style.display='inline-block'; document.getElementById('filersbuttonopen').style.display='none'; document.getElementById('filersbuttonclose').style.display='inline-block';">Выбрать фильтры</button>
                    <button id="filersbuttonclose" class="btn btn-outline-primary" style="margin-bottom: 10px; display: none;" onclick="getCheckedCheckBoxes()">Применить фильтры</button>
                </div>
                <?php   
                if(isset($_GET['filters']) and $_GET['filters'] != "") {
                    $filters = explode(" ", $_GET['filters']);
                    $filter = "";

                    for ($i = 0; $i < count($filters); $i++) {
                        if ($i == count($filters) - 1)
                            $filter = $filter . 'LOCATE(\'' . $filters[$i] . '\', `tags`) ';
                        else $filter = $filter . 'LOCATE(\'' . $filters[$i] . '\', `tags`) or ';                                   
                    }
                    $query = mysqli_query($db,"SELECT * FROM `work` WHERE `isdelete` = '0' and " . $filter); 
                    if (mysqli_num_rows($query) == 0) {
                        echo "<div class='text-center' style='font-size: xx-large;'>Ничего не найдено!</div>";
                    } else {                                    
                        echo '<div class="row">';
                        while ($data = $query -> fetch_assoc()) {
                            echo '
                            <div class="col-sm">
                                <figure class="figure">
                                    <a href="view.php?id=' . $data['id'] . '"><img src="works/' . $data['id'] . "/" . $data['preview_img'] . '"class="rounded" style="width: 300px; height: 300px;" alt="img"></a>
                                    <figcaption class="figure-caption text-start">' . $data['modelname'] . "<br>От: " . $data['Creator'] . '</figcaption>
                                </figure>
                            </div>';
                        }
                        echo '</div>';
                    }
                }  
                else {
                    $query = mysqli_query($db,"SELECT * FROM `work` WHERE `isdelete` = '0'");
                    echo '<div class="row">'; 
                    while ($data = $query -> fetch_assoc()) {
                        echo '
                        <div class="col-sm">
                            <figure class="figure">
                                <a href="view.php?id=' . $data['id'] . '"><img src="works/' . $data['id'] . "/" . $data['preview_img'] . '"class="rounded" style="width: 300px; height: 300px;" alt="img"></a>
                                <figcaption class="figure-caption text-start">'. $data['modelname'] . " <br>От: " . $data['Creator'] .'</figcaption>
                            </figure>
                        </div>';
                    }                                
                    echo '</div>';
                }         
                ?>
        <script>
            function getCheckedCheckBoxes() {
                var checkboxes = document.getElementsByTagName('input');
                var checkboxesChecked = []; 
                var url = "";
                for (var index = 0; index < checkboxes.length; index++) {
                    if (checkboxes[index].checked) {
                        checkboxesChecked.push(checkboxes[index].value);
                        url += checkboxes[index].value + " ";
                    }
                }                
                window.location.href = "index.php?filters=" + url;
            }
        </script>