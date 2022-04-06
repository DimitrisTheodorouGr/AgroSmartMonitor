<html>
    <head>
        <meta charset='utf-8'>
        <title>Agro Smart Monitor</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        
 
    </head>
    <body>
    
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
            <nav class="navbar navbar-inverse ">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <span class="navbar-text">Agro Smart Monitor</span>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="User.php">Αρχική</a></li>
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                    
                   
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li>
                            <span class="navbar-text">
                                <?php
                                    echo' <img src="Logos/user_icon-removebg-preview.png" width="25" height="25">  '. $user;
                                ?>
                            </span>
                        </li>
                        <li>
                            <a href="logout.php">
                                <span class="glyphicon glyphicon-log-out"> </span> LogOut
                            </a>
                        </li>
                    </ul>
                    
                        
                    
                </div>
            </nav>


            <div class="container">
              
                <h2>Οι αισθητήρες μου</h2>
                          
                <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Αισθητήρας</th>
                        <th>Τοποθεσία</th>
                        <th>Ενεργός τελευταία φορά </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    $query15 = "SELECT `ID_DEVICE`, `LONGITUDE`, `LATITUDE`, `LAST_ACTIVE` FROM `sensor` WHERE ID_DEVICE IN (SELECT `ID_DEV` FROM `person_has_sensor` WHERE ID_P = '". $id ."')";
                    $result15 = mysqli_query($link,$query15);
                    if($result15 = mysqli_query($link, $query15))
                             {
                                 if(mysqli_num_rows($result15) > 0)
                                 {   
                                 for($x=0;$x<mysqli_num_rows($result15);$x++)
                                     {
                                         $row = mysqli_fetch_array($result15);
                                                 echo "<tr>";
                                                 
                                                     echo "<td>" . $row['ID_DEVICE'] . "</td>";
                                                     echo "<td>" . $row['LONGITUDE'] . " // ".$row['LATITUDE']. "</td>";
                                                     echo "<td>" . $row['LAST_ACTIVE'] . "</td>";   
                                                 echo "</tr>";
                                     } 
                                     // Free result set
                                     mysqli_free_result($result15);
                                 } 
                                 else 
                                {   
                                    echo "<tr>";           
                                    echo "<td> NO Sensors </td>";  
                                    echo "</tr>"; 
                                }
                             }
                        
                    ?>
                    </tbody>
                </table>
                

             </div>
            <div class="container">
                    
                    <form action="User.php" method="POST">
                        <label for="sensors" class="form-label">Επέλεξε έναν αισθητήρα</label>
                        <input class="form-control" list="sensor" name="sensors" id="sensors">
                        <datalist id="sensor">
                                
                                            
                            <?php
                                $result15 = mysqli_query($link,$query15);
                                if(mysqli_num_rows($result15) > 0)
                                { 
                                    for($x=0;$x<mysqli_num_rows($result15);$x++)
                                    {
                                    $row = mysqli_fetch_array($result15);
                                                    
                                    echo "<option value=". $row['ID_DEVICE'] ." name=\"sens\" >" ;
                                                                    
                                    
                                    } 
                                    // Free result set
                                    mysqli_free_result($result15);
                                } 
                                else 
                                {   
                                       
                                echo "<option value= 'NO Sensors'>";  
                              
                                }
                                            
                            ?>
                        </datalist>    
                        <input type="submit" id="show_button" value="Επιλογή">
                    </form>
                </div>
            <div class="container" >
                <div class="text-center" > 
                    <h2>Γραφήματα</h2> 
                </div>
                
            <?php
                if(isset($_POST['sensors'])){
                    $sen = $_POST['sensors'];
  
                    }
                if(!empty($_POST['sensors']))
                {  
                    //query to get data from the table
                    
                    $query = sprintf("SELECT   `HUMIDITY_AIR`, `TEMPERATURE_AIR`, `MOISTURE_GRD`, `TEMPERATURE_GRD_50CM`, 
                    `TEMPERATURE_GRD_100CM`, `LEAF_WEATNESS`, `PHOTOSENSOR` ,`V_Timestamp` FROM `s_values` WHERE DEVICE = '". $sen ."' ");

                    //execute query
                    //$result = $mysqli->query($query);
                    $result = mysqli_query($link,$query);
                    //loop through the returned data
                    $Humidity_air_Array = [];
                    $date_Array= [];
                    
                        if(mysqli_num_rows($result) > 0)
                        {   
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
                    
                        
                         
                    }
                   
                }else {
                    echo '<h4 class=" fixed-top text-center"> Δεν υπάρχουν δεδομένα </h4>'; 
                }
            ?>
            <canvas id="mycanvas"></canvas>
            </div>
            
            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/Chart.min.js"></script>
           
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
    <div class=" container text-center fixed-bottom">
        <p>&copy; Developed by Theodorou Dimitris </p>
    </div>   
    
    </body>
</html>