<html>
    <head>
        <meta charset='utf-8'>
        <title>Agro Smart Monitor</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
         <!-- Add icon library -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
        <style> 
         .weather_contxt {
            
            margin: auto;
            width: 20%;
            text-align: center;
            border-style: solid;
            border-width: 3px;
         }
        </style>
    </head>
    <body>
    
        <?php
              
               session_start();
               $id = $_SESSION['ID_AFM'];

                require 'config.php';
                //Query for request from database id that comes from login page
                $query1 = "SELECT `USERNAME`, `CITYID_OWA` FROM PERSON WHERE ID_AFM ='$id'";
                $result1 = mysqli_query($link,$query1);
                
                
                $num = mysqli_num_rows($result1);
		
		        if($num != 0)/* email and password exists */
                { 
                    $data1 = mysqli_fetch_array($result1);
                    $user = $data1['USERNAME'];
                    $cityId = $data1['CITYID_OWA'];

                    
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
                            <a class="nav-link " href="User_Home.php">Αρχική</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="User_Jobs.php">Εργασίες</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="User_Weather.php">Καιρός</a>
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

            
            <div class="container-fluid">
              
                <h2>Ο καιρός τώρα </h2>

                <?php

                  
                    $apiKey = "f876c085d787ec56a6bff611680b80c4";
                   // $cityId = "735016";
                    $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=el&units=metric&APPID=" . $apiKey;

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_VERBOSE, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($ch);
                    
                    curl_close($ch);
                    $data = json_decode($response);
                    ?>
                    <div class="report-container" >
                            <div class= " weather_contxt">
                                <h4><?php echo $data->name; ?> </h4>
                            </div>    
                            <div class= " weather_contxt">
                                <div>
                                    <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"class="weather-icon" /> 
                                    <?php echo ucwords($data->weather[0]->description); ?>
                                </div>
                            </div>
                            <div class= " weather_contxt">
                                
                                   Θερμοκρασία: <?php echo $data->main->temp; ?>°C <br>
                                   Μεγ. Θερμοκρασία: <?php echo $data->main->temp_max; ?>°C <br>
                                   Ελαχ. Θερμοκρασία: <?php echo $data->main->temp_min; ?>°C <br>
                                   Αίσθηση εώς: <?php echo $data->main->feels_like; ?>°C <br>
                            </div>
                            <div class= " weather_contxt" >
                                <div>
                                    Υγρασία: <?php echo $data->main->humidity; ?> % <br>
                                    Πίεση: <?php echo $data->main->pressure; ?> hPa

                                </div>
                                <div>
                                    Ταχύτητα αέρα: <?php echo $data->wind->speed; ?> km/h <br>
                                    Κατεύθυνση αέρα: <?php echo $data->wind->deg; ?> ° 
                                    <?php 
                                    $degrees=$data->wind->deg; 
                                    if($degrees >= 67 && $degrees <= 111 ){
                                        echo "Ανατολικά";
                                    }  
                                    elseif($degrees >= 112 && $degrees <= 156 ){
                                        echo "Νοτιο-Ανατολικά";
                                    } 
                                    elseif($degrees >= 157 && $degrees <= 202 ){
                                        echo "Νότια";
                                    } 
                                    elseif($degrees >= 203 && $degrees <= 246 ){
                                        echo "Νοτιο- Δυτικά";
                                    }
                                    elseif($degrees >= 247 && $degrees <= 292 ){
                                        echo "Δυτικά";
                                    } 
                                    elseif($degrees >= 293 && $degrees <= 336 ){
                                        echo "Βορειο-Δυτικά";
                                    }
                                    elseif($degrees >= 337 && $degrees <= 22 ){
                                        echo "Βόρεια";
                                    }
                                    elseif($degrees >= 23 && $degrees <= 66 ){
                                        echo "Βορειο-Ανατολικά";
                                    }    
                                    ?>
                                    <br>
                                </div>
                            </div>
                    </div>
             </div>
             
             
             <div class="container-fluid" id="forecast_chart">

               

                <?php

                    $apiKey = "f876c085d787ec56a6bff611680b80c4";
                    // $cityId = "735016";
                    $googleApiUrl = "http://api.openweathermap.org/data/2.5/forecast?id=" . $cityId . "&lang=el&units=metric&APPID=" . $apiKey;

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_VERBOSE, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $response2 = curl_exec($ch);

                    curl_close($ch);
                    $array = json_decode($response2);
                    $currentTime = time()+ (60*60);// for greece time
                    //echo $array->cnt ."Timestamps";
                    $temp = [];
                    $feels_like = [];
                    $temp_min = [];
                    $temp_max = [];
                    $pressure = [];
                    $humidity = [];
                    $dt_text = [];
                    

                    for($i=0;$i<$array->cnt;$i++){
                        $temp [] =$array->list[$i]->main->temp; 
                        $feels_like []=$array->list[$i]->main->feels_like;
                        $temp_min []=$array->list[$i]->main->temp_min;
                        $temp_max []=$array->list[$i]->main->temp_max;
                        $pressure []=$array->list[$i]->main->pressure;
                        $humidity []=$array->list[$i]->main->humidity;
                        $dt_text []=$array->list[$i]->dt_txt;
                        $wind_sp [] =$array->list[$i]-> wind->speed;
                        $wind_deg [] =$array->list[$i]->wind->deg;

                    }
                    
                    //echo $array->list[0]->main->temp;
                     
                ?>
                <h3>Πρόγνωση Καιρού</h3>
                <div class="row">

                    <div class="col-9">
                        <canvas id="forecast_main_canvas"></canvas> 
                    </div>

                    <div class="col-3">
                    <h4>Κατεύθυνση αέρα </h4><br>
                        <img src="Logos/compass_rose_500x.png" width="300" height="300"/> 
                    </div>
                    

                </div>
                

             </div>
  
            
    <div class=" container text-center ">
        <p>&copy; Developed by Theodorou Dimitris </p>
    </div> 
    <!-- for Chartjs library-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>  
   <!-- Create forecast chart-->
   <script>


    const Temp = <?=  json_encode($temp); ?>;
    const Feels_like = <?=  json_encode($feels_like); ?>;
    const Temp_min = <?=  json_encode($temp_min); ?>;
    const Temp_max = <?=  json_encode($temp_max); ?>;
    const Pressure = <?=  json_encode($pressure); ?>;
    const Humidity = <?=  json_encode($humidity); ?>;
    const DT_text = <?=  json_encode($dt_text); ?>;
    const Wind_sp = <?=  json_encode($wind_sp); ?>;
    const Wind_deg = <?=  json_encode($wind_deg); ?>;
        
    var chartdata_main = {
                labels: DT_text,
                datasets : [
                {
                    label: 'Θερμοκρασία (°C)' ,
                    borderColor: 'rgba(20, 20, 100, 0.75)',
                    hoverBackgroundColor: 'rgba(20, 20, 100, 0.75)',
                    hoverBorderColor: 'rgba(20, 20, 100, 0.75)',
                    fill: false,
                    data: Temp
                },
                {
                    label: 'Αίσθηση εώς (°C)' ,
                    borderColor: 'rgba(255, 51, 153, 0.75)',
                    hoverBackgroundColor: 'rgba(255, 51, 153, 0.75)',
                    hoverBorderColor: 'rgba(255, 51, 153, 0.75)',
                    fill: false,
                    data: Feels_like
                },
                {
                    label: 'Μεγ. θερμοκρασία (°C)' ,
                    borderColor: 'rgba(255, 0, 0, 0.75)',
                    hoverBackgroundColor: 'rgba(255, 0, 0, 0.75)',
                    hoverBorderColor: 'rgba(255, 0, 0, 0.75)',
                    fill: false,
                    data: Temp_max
                },
                {
                    label: 'Ελαχ. θερμοκρασία (°C)' ,
                    borderColor: 'rgba(0, 0, 255, 0.75)',
                    hoverBackgroundColor: 'rgba(0, 0, 255, 0.75)',
                    hoverBorderColor: 'rgba(0, 0, 255, 0.75)',
                    fill: false,
                    data: Temp_min
                },
                {
                    label: 'Υγρασία (%)' ,
                    borderColor: 'rgba(0, 255, 255, 0.75)',
                    hoverBackgroundColor: 'rgba(0, 255, 255, 0.75)',
                    hoverBorderColor: 'rgba(0, 255, 255, 0.75)',
                    fill: false,
                    data: Humidity
                },
                {
                    label: 'Πίεση (hPa)' ,
                    borderColor: 'rgba(132, 132, 132, 0.75)',
                    hoverBackgroundColor: 'rgba(132, 132, 132, 0.75)',
                    hoverBorderColor: 'rgba(132, 132, 132, 0.75)',
                    fill: false,
                    data: Pressure
                },
                {
                    label: 'Ταχύτητα αέρα (m/s)' ,
                    borderColor: 'rgba(250, 60, 100, 0.75)',
                    hoverBackgroundColor: 'rgba(250, 60, 100, 0.75)',
                    hoverBorderColor: 'rgba(250, 60, 100, 0.75)',
                    fill: false,
                    data: Wind_sp
                },
                {
                    label: 'Κατεύθυνση αέρα (°)' ,
                    borderColor: 'rgba(40, 200, 140, 0.75)',
                    hoverBackgroundColor: 'rgba(40, 200, 140, 0.75)',
                    hoverBorderColor: 'rgba(40, 200, 140, 0.75)',
                    fill: false,
                    data: Wind_deg
                },
                ]
                };

    var ctx = $("#forecast_main_canvas");

    var barGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata_main
    });


   </script>

    

    </body>
</html>