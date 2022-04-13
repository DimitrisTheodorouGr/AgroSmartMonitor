<html>
    <head>
        <meta charset='utf-8'>
        <title>Agro Smart Monitor</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
        
 
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
                            <a class="nav-link" href="#">Page 2</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link" href="#">Page 3</a>
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
                                <?php
                                    echo' <img src="Logos/logout-sign-icon-log-out-symbol-arrow-vector-2682061.jpeg" width="25" height="25"> &nbsp LogOut  ';
                                ?> 
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
                    
                    <form action="User_Home.php" method="POST">
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
                        </datalist> <br>
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
            <div class="container" >
                <div class="text-center" > 
                    <h2>Γραφήματα</h2> 
                </div>
                
            <?php
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
                   
                    //execute query
                    $result = mysqli_query($link,$query);
                    //loop through the returned data
                    $Humidity_air_Array = [];
                    $date_Array = [];
                    $Temp_air_Array = [];
                    $Moisture_grd_array = [];
                    $temp_grd_50_arr = [];
                    $temp_grd_100_arr = [];
                    $leaf_weat_arr = [];
                    $photos_array = [];
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
                   
                } else if(!empty($_POST['sensors']) && !empty($_POST['date_from']) && !empty($_POST['date_to'])  )
                {  
                    //query to get data from the table
                    $query = sprintf("SELECT  `HUMIDITY_AIR`, `TEMPERATURE_AIR`, `MOISTURE_GRD`, `TEMPERATURE_GRD_50CM`, `TEMPERATURE_GRD_100CM`, `LEAF_WEATNESS`,
                     `PHOTOSENSOR` ,`V_Timestamp` FROM `s_values` WHERE DEVICE = '". $sen ."' AND (`V_Timestamp` BETWEEN '". $date_from ."' AND '". $date_to ."');");
                   
                   
                    //execute query
                    
                    $result = mysqli_query($link,$query);
                    //loop through the returned data
                    $Humidity_air_Array = [];
                    $date_Array= [];
                    $Temp_air_Array = [];
                    $Moisture_grd_array = [];
                    $temp_grd_50_arr = [];
                    $temp_grd_100_arr = [];
                    $leaf_weat_arr = [];
                    $photos_array = [];

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
                   
                }else if(!empty($_POST['sensors']) && isset($_POST['quick_button']) )
                {  
                    if($_POST['quick_button']== 'day')
                    {
                        $date_from= date("Y-m-d  00:00");
                        $date_to = date("Y-m-d 23:59");   
                    }
                    else if($_POST['quick_button']== 'month')
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
                            else
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
                    else
                    {

                    }
                    
                   // echo $date_from .'<br>'. $date_to;
                    //query to get data from the table
                    $query = sprintf("SELECT  `HUMIDITY_AIR`, `TEMPERATURE_AIR`, `MOISTURE_GRD`, `TEMPERATURE_GRD_50CM`, `TEMPERATURE_GRD_100CM`, `LEAF_WEATNESS`,
                     `PHOTOSENSOR` ,`V_Timestamp` FROM `s_values` WHERE DEVICE = '". $sen ."' AND (`V_Timestamp` BETWEEN '". $date_from ."' AND '". $date_to ."');");

                    //execute query
                    $result = mysqli_query($link,$query);
                    //loop through the returned data
                    $Humidity_air_Array = [];
                    $date_Array= [];
                    $Temp_air_Array = [];
                    $Moisture_grd_array = [];
                    $temp_grd_50_arr = [];
                    $temp_grd_100_arr = [];
                    $leaf_weat_arr = [];
                    $photos_array = [];

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
                    echo '<h6 class=" text-center"> Δεν υπάρχουν δεδομένα </h6>'; 
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
    <div class=" container text-center ">
        <p>&copy; Developed by Theodorou Dimitris </p>
    </div>   
    
    </body>
</html>