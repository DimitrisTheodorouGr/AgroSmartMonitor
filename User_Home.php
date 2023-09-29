<html>
    <head>
        <meta charset='utf-8'>
        <title>Agro Smart Monitor</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
       
        <!-- MAP-->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
         <!-- Add icon library -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
  
    </head>
    <body >
    
        <?php
               //From login.php  takes ID;
               session_start();
               $id = $_SESSION['ID_AFM'];

                require 'config.php';
                //Query for request from database id that comes from login page
                $query1 = "SELECT `USERNAME`, `STATUS` FROM PERSON WHERE ID_AFM ='$id'";
                $result1 = mysqli_query($link,$query1);
                
                
                $num = mysqli_num_rows($result1);
		
		        if($num != 0)/* email and password exists */
                { 
                    $data1 = mysqli_fetch_array($result1);
                    $user = $data1['USERNAME'];
                    $role = $data1['STATUS'];

                    
                }

 
               
        ?>
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <span class="navbar-text">Agro Smart Monitor &nbsp &nbsp</span>
                        
                    </div>
                    <div class="collapse navbar-collapse" >
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link active" href="User_Home.php">Αρχική</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="User_Jobs.php">Εργασίες</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="User_Weather.php">Καιρός</a>
                        </li>
                      
                    </ul>
                    </div>
                   
                    <ul class="navbar-nav navbar-right">
                        
                        <li class="nav-item">
                            <span class="navbar-text">
                                <?php
                                    echo' <img src="Logos/user_icon-removebg-preview.png" width="40" height="40">  '. $user;
                                ?>&nbsp
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                            <i class="fa fa-sign-out"></i> LogOut  
                            </a>
                        </li>
                    </ul>
                    
                        
                    
                </div>
            </nav>
            
            
            <br>
            
            <div class="container-fluid" style="width:80%">
              
                <h2>Οι αισθητήρες μου</h2>
                <div class="row">
                        <div class="col-7">
                            <div id="map" style="width: 90%; height: 500px;"></div>
                            <!--  Requesting data for the markers on the map-->
                            <?php
                                    //query to get data from the table
                                    $query = sprintf("SELECT `ID_DEVICE`, `LONGITUDE`, `LATITUDE` FROM `sensor` 
                                    WHERE ID_DEVICE IN (SELECT `ID_DEV` FROM `person_has_sensor` WHERE ID_P = '". $id ."')");
                                
                                
                                    //execute query
                                    $result = mysqli_query($link,$query);
                                    //loop through the returned data
                                
                                    if(mysqli_num_rows($result) > 0)
                                    {   
                                        for($x=0;$x<mysqli_num_rows($result);$x++)
                                        {
                                            $row = mysqli_fetch_array($result);

                                            $meta[] = array(
                                                'id' => $row['ID_DEVICE'],
                                                'lon' => $row['LONGITUDE'],
                                                'lat' => $row['LATITUDE']
                                            );
                                        }
                
                                    }
                                ?>
            
                        

                        </div>
                         <!-- Every time a sensor is added or the 'last active' changes the table is loaded again without reloading the whole page-->
                        <div class="col-5" id="tablesensor">  </div>  
                        
                
                

             </div>
             <br>
            <div class="container">
                    
                    <form action="User_Home.php" method="POST">
                        <label for="sensors" class="form-label">Επέλεξε έναν αισθητήρα: </label>
                        <br>
                        <!--  Creating list of sensors available to each user-->
                        <select  id="sensors" name="sensors" style="height:4%; width:20%;">
                            <option disabled selected value> --Επέλεξε-- </option>      
                                            
                            <?php
                                $query15 = "SELECT `ID_DEVICE`, `LAST_ACTIVE` FROM `sensor` 
                                WHERE ID_DEVICE IN (SELECT `ID_DEV` FROM `person_has_sensor` WHERE ID_P = '". $id ."')";
                                $result15 = mysqli_query($link,$query15);
                                if(mysqli_num_rows($result15) > 0)
                                { 
                                    for($x=0;$x<mysqli_num_rows($result15);$x++)
                                    {
                                    $row = mysqli_fetch_array($result15);
                                                    
                                    echo "<option value=". $row['ID_DEVICE'] ." name=\"sens\" > ". $row['ID_DEVICE'] ." </option>" ;
                                                                    
                                    
                                    } 
                                    // Free result set
                                    mysqli_free_result($result15);
                                } 
                                else 
                                {   
                                       
                                echo "<option value= 'NO Sensors'>";  
                              
                                }
                                            
                            ?>
                        </select> <br>
                        <label class="form-label">Επέλεξε ημερομηνία</label><br>
                        <label for="date_from">Από:</label> 
                        <input type="datetime-local" id="date_from" name="date_from">
                        <label for="date_from">Εώς:</label> 
                        <input type="datetime-local" id="date_to" name="date_to"><br>
                        <h6>Γρήγορες Επιλογές</h6>
                        <label for="day_button"> Μετρήσεις ημέρας</label> 
                        <input type="radio" id="day_button" name="quick_button" value= "day">
                        <label for="week_button"> Μετρήσεις Εβδομάδας</label> 
                        <input type="radio" id="week_button" name="quick_button" value= "week">
                        <label for="month_button"> Μετρήσεις Μήνα</label> 
                        <input type="radio" id="month_button" name="quick_button" value= "month">
                        <br><br>
                        <input type="submit" id="show_button" value="Επιλογή">
                    </form>
                </div>
            <div class="container" id="charts" >
                <div class="text-center" > 
                    <h2>Γραφήματα</h2> 
                </div>
                
            <?php
                // echo $_POST['sensors'];

                if(isset($_POST['sensors']))
                {
                    $sen = $_POST['sensors'];
                }
                if(isset($_POST['date_from']))
                {
                    $date_from = $_POST['date_from'];
                }
                if(isset($_POST['date_to']))
                {
                    $date_to = $_POST['date_to'];
                }

              
                
                //When user hasn't set the date for data to be displayed the default is the 10 last values of the sensor he selected
                if(!empty($_POST['sensors']) && empty($_POST['date_from']) && empty($_POST['date_to']) && !isset($_POST['quick_button']) )
                {  
                    //query to get data from the table
                    $query = sprintf("SELECT * FROM (SELECT ID_V, `HUMIDITY_AIR`, `TEMPERATURE_AIR`, `MOISTURE_GRD`, `TEMPERATURE_GRD_50CM`, 
                    `TEMPERATURE_GRD_100CM`, `LEAF_WEATNESS`, `PHOTOSENSOR` ,`V_Timestamp` FROM `s_values` 
                    WHERE DEVICE = '". $sen ."' ORDER BY ID_V DESC LIMIT 10) var1 ORDER BY ID_V ASC ;");
                    
                    echo "<h6 class=\"text-center\"> Για τον αισθητήρα: ".$sen." </h6>"; 
                   
                } 
                else if(!empty($_POST['sensors']) && !empty($_POST['date_from']) && !empty($_POST['date_to'])  )
                {  
                    //query to get data from the table
                    $query = sprintf("SELECT  `HUMIDITY_AIR`, `TEMPERATURE_AIR`, `MOISTURE_GRD`, `TEMPERATURE_GRD_50CM`, `TEMPERATURE_GRD_100CM`, `LEAF_WEATNESS`,
                     `PHOTOSENSOR` ,`V_Timestamp` FROM `s_values` WHERE DEVICE = '". $sen ."' AND (`V_Timestamp` BETWEEN '". $date_from ."' AND '". $date_to ."');");
                
                    echo "<h6 class=\"text-center\"> Για τον αισθητήρα: ".$sen." </h6>"; 
                   
                }
                else if(!empty($_POST['sensors']) && isset($_POST['quick_button']) )
                {  
                    if($_POST['quick_button']== 'day')//day button
                    {
                        $date_from= date("Y-m-d  00:00");
                        $date_to = date("Y-m-d 23:59");   
                    }
                    else if($_POST['quick_button']== 'month')//month button
                    {
                        if (date("m")%2 == 0)
                        {   //Φεβρουάριος
                            if (date("m") == 2 )
                            {   //Δύσεκτο έτος
                                if( (date("Y")% 4 == 0   && date("Y")% 100 <> 0 ) || date("Y")% 400 == 0 ) 
                                {
                                    $date_from= date("Y-m-01  00:00");
                                    $date_to = date("Y-m-29 23:59"); 
                                }
                                else
                                {
                                    $date_from= date("Y-m-01  00:00");
                                    $date_to = date("Y-m-28 23:59"); 
                                }

                            }
                            //Αύγουστος
                            elseif  (date("m") == 8 ){
                                $date_from= date("Y-m-01  00:00");
                                $date_to = date("Y-m-31 23:59"); 

                            }
                            else //Απρίλιος ,Ιούνιος ,Σεπτέμβριος ,Νοέμβριος
                            {
                                $date_from= date("Y-m-01  00:00");
                                $date_to = date("Y-m-30 23:59"); 
                            }
                            
                            
                        } 
                        else 
                        {
                            $date_from= date("Y-m-01  00:00");
                            $date_to = date("Y-m-31 23:59"); 
                        }
                        
                        
                    }
                    else //week button
                    {
                        $date_from= date("Y-m-d  00:00", strtotime('-6 days'));
                        $date_to = date("Y-m-d 23:59"); 

                    }
                    //echo $date_from .'<br>'. $date_to;
                    //query to get data from the table
                    $query = sprintf("SELECT  `HUMIDITY_AIR`, `TEMPERATURE_AIR`, `MOISTURE_GRD`, `TEMPERATURE_GRD_50CM`, `TEMPERATURE_GRD_100CM`, `LEAF_WEATNESS`,
                     `PHOTOSENSOR` ,`V_Timestamp` FROM `s_values` WHERE DEVICE = '". $sen ."' AND (`V_Timestamp` BETWEEN '". $date_from ."' AND '". $date_to ."');");
                    
                    echo "<h6 class=\"text-center\"> Για τον αισθητήρα: ".$sen." </h6>"; 
                }
                else {
                    //query to get data from the table
                    $query = sprintf("SELECT * FROM (SELECT ID_V, DEVICE, `HUMIDITY_AIR`, `TEMPERATURE_AIR`, `MOISTURE_GRD`, `TEMPERATURE_GRD_50CM`, 
                    `TEMPERATURE_GRD_100CM`, `LEAF_WEATNESS`, `PHOTOSENSOR` ,`V_Timestamp` FROM `s_values` 
                    WHERE DEVICE = (SELECT MIN(ID_DEV) FROM person_has_sensor WHERE ID_P = '".$id."' ) ORDER BY ID_V DESC LIMIT 10) var1 ORDER BY ID_V ASC ;");
                    
                    $query3="SELECT MIN(ID_DEV) AS DEV FROM person_has_sensor WHERE ID_P = '".$id."'";
                    $result3 = mysqli_query($link,$query3);
                    $n = mysqli_fetch_array($result3);
                    
                    echo "<h6 class=\"text-center\"> Για τον αισθητήρα: ". $n['DEV']." </h6>"; 
                    

                } 
                    //execute query    
                    $result = mysqli_query($link,$query);
                    if($result = mysqli_query($link, $query))
                    {
                        if(mysqli_num_rows($result) > 0)
                        {   
                            
                            $Humidity_air_Array = [];
                            $date_Array= [];
                            $Temp_air_Array = [];
                            $Moisture_grd_array = [];
                            $temp_grd_50_arr = [];
                            $temp_grd_100_arr = [];
                            $leaf_weat_arr = [];
                            $photos_array = [];

                            //loop through the returned data

                            for($x=0;$x<mysqli_num_rows($result);$x++)
                            {
                                $row = mysqli_fetch_array($result);
                                $Humidity_air_Array[] = $row['HUMIDITY_AIR'];
                                $date_Array[] =$row['V_Timestamp'];
                                $Temp_air_Array[] = $row['TEMPERATURE_AIR'];
                                $Moisture_grd_array[] =$row['MOISTURE_GRD'];
                                $temp_grd_50_arr[] = $row['TEMPERATURE_GRD_50CM'];
                                $temp_grd_100_arr[] = $row['TEMPERATURE_GRD_100CM'];
                                $leaf_weat_arr[] = $row['LEAF_WEATNESS'];
                                $photos_array[] = $row['PHOTOSENSOR'];
                            }
                        
                            
                            
                        }else {
                            echo '<h6 class=" text-center" style="color: red;"> Δεν υπάρχουν δεδομένα για τις ημερομηνίες που επιλέξατε. </h6>'; 
                        }
                    }
                ?>
                <canvas id="mycanvas"></canvas>
            </div>
           
            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/Chart.min.js"></script>
           <!-- Create charts with data from database-->
           <script type="text/javascript" >


                const Time = <?=  json_encode($date_Array); ?>;
                const Air_humidity = <?=  json_encode($Humidity_air_Array); ?>;
                const Temp_air = <?=  json_encode($Temp_air_Array); ?>;
                const Moisture_grd = <?=  json_encode($Moisture_grd_array); ?>;
                const Temp_grd_50 = <?=  json_encode($temp_grd_50_arr); ?>;
                const Temp_grd_100 = <?=  json_encode($temp_grd_100_arr); ?>;
                const Leaf = <?=  json_encode($leaf_weat_arr); ?>;
                const PhotoSensor = <?=  json_encode($photos_array); ?>;


                var chartdata = {
                    labels: Time,
                    datasets : [
                    {
                        label: 'Υγρασία αέρα' ,
                    // backgroundColor: 'rgba(20, 20, 100, 0.75)',
                        borderColor: 'rgba(20, 20, 100, 0.75)',
                        hoverBackgroundColor: 'rgba(20, 20, 100, 0.75)',
                        hoverBorderColor: 'rgba(20, 20, 100, 0.75)',
                        fill: false,
                        data: Air_humidity
                    },{
                        label:  'Θερμοκρασία αέρα',
                        //backgroundColor: 'rgba(200, 200, 200, 0.75)',
                        borderColor: 'rgba(100, 230, 70, 0.75)',
                        hoverBackgroundColor: 'rgba(100, 230, 70, 0.75)',
                        hoverBorderColor: 'rgba(100, 230, 70, 0.75)',
                        fill: false,
                        data: Temp_air
                    }, {
                        label: 'Υγρασία εδάφους',
                        //backgroundColor: 'rgba(200, 200, 200, 0.75)',
                        borderColor: 'rgba(20, 100, 90, 0.75)',
                        hoverBackgroundColor: 'rgba(20, 100, 90, 0.75)',
                        hoverBorderColor: 'rgba(20, 100, 90, 0.75)',
                        fill: false,
                        data: Moisture_grd
                    }, {
                        label: 'Θερμοκρασία εδάφους σε βάθος 50εκ.',
                        //backgroundColor: 'rgba(200, 200, 200, 0.75)',
                        borderColor: 'rgba(36, 218, 212, 0.75)',
                        hoverBackgroundColor: 'rgba(36, 218, 212, 0.75)',
                        hoverBorderColor: 'rgba(36, 218, 212, 0.75)',
                        fill: false,
                        data: Temp_grd_50
                    }, {
                        label: 'Θερμοκρασία εδάφους σε βάθος 100εκ.',
                    // backgroundColor: 'rgb(255,0,0)',
                        borderColor: 'rgb(255,0,0)',
                        hoverBackgroundColor: 'rgb(255,0,0)',
                        hoverBorderColor: 'rgb(255,0,0)',
                        fill: false,
                        data: Temp_grd_100
                    },{
                        label: 'Υγρασία φύλλου',
                        //backgroundColor: 'rgba(0,0,255, 0.75)',
                        borderColor: 'rgba(0,0,255, 0.75)',
                        hoverBackgroundColor: 'rgba(0,0,255, 1)',
                        hoverBorderColor: 'rgba(0,0,255, 1)',
                        fill: false,
                        data: Leaf,
                    },{
                        label: 'Ηλιακή ακτινοβολία',
                        //backgroundColor: 'rgba(200, 200, 200, 0.75)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        fill: false,
                        data: PhotoSensor
                    }
                    ]
                };

                var ctx = $("#mycanvas");

                var barGraph = new Chart(ctx, {
                    type: 'line',
                    data: chartdata
                });

           </script>
            <script>
                // initialize Leaflet
                var map = L.map('map').setView({lat: 40.329928, lon: 23.147261}, 6);
               
                const meta= <?=  json_encode($meta); ?>;
              
               // Add the OpenStreetMap layer
               var lyrOSM = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
                }).addTo(map);
                
              //Add the Google Hybrid layer
               var lyrGoogleHybrid = L.tileLayer('http://mts2.google.com/vt/lyrs=y&x={x}&y={y}&z={z}',{
                    maxZoom:22,
                    maxNativeZoom:18
                })
                map.addLayer(lyrGoogleHybrid);
                //Create the side bar for selection
                objBaseMap = {
                    "OpenStreetMap" :lyrOSM,
                    "Google-Hybrid":lyrGoogleHybrid
                }
                L.control.layers(objBaseMap).addTo(map);

                
                // show the scale bar on the lower left corner
                L.control.scale({imperial: true, metric: true}).addTo(map);

                
                //console.log(meta);
                //console.log(meta.length);

               // show a marker on the map
               for (var i=0;i< Object.keys(meta).length; i++ ){
                 L.marker([parseFloat(meta[i]["lon"]),parseFloat(meta[i]["lat"])]).bindPopup(meta[i]["id"]).addTo(map).openPopup(); 
               }
                
                //Poligon
                //var polygon = L.polygon([[37, -109.05],[41, -109.03],[41, -102.05],[37, -102.04]], {color: 'red'}).addTo(map);

            </script>
            <!-- refresh sensor table every 10 sec-->
            <script type="text/javascript">
                $(document).ready(function(){
                refreshTable();
                });

                function refreshTable(){
                    $('#tablesensor').load('get_table_sensors.php', function(){
                    setTimeout(refreshTable, 10000); // 10sec
                    });
                }
            </script>
    <div class=" container text-center ">
        <p>&copy; Developed by Theodorou Dimitris </p>
    </div>   
    
    </body>
</html>