<html>
    <head>
        <meta charset='utf-8'>
        <title>Agro Smart Monitor</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        
        <!-- FOR TABLE CELL COLOUR-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            select {
                background-color: white transparent;
                width:100%; 
                height:35px;
                font-family: Arial;
                border-color: grey ;
            }

            .btn {
                background-color: #CB1010; /* Dark red */
                border: none;
                color: white;
                padding: 12px 16px;
                font-size: 16px;
                cursor: pointer;
            }
            .btn2 {
                background-color: #0E6EEB; /* Dark red */
                border: none;
                color: white;
                padding: 12px 16px;
                font-size: 16px;
                cursor: pointer;
            }
            /* Darker background on mouse-over */
            .btn:hover {
                background-color: #FF0000;/* Light red */
            }
        </style>
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
        <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
       
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
                            <a class="nav-link " href="Admin_Home.php">Αρχική</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="Admin_Jobs.php">Εργασίες</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Admin_Create.php">Προσθήκη</a>
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
                <h2>Δημιουργία πελάτη</h2>
                <form action="Admin_Create.php" method="POST">
                    <div class="row">
                            <div class="col-2">
                                <h6> ΑΦΜ:</h6> 
                                <input  id="afm" name="amf" type="text">
                            </div>
                            <div class="col-2">
                                <h6> Όνομα:</h6> 
                                <input  id="name" name="name" type="text">
                            </div>
                            <div class="col-2">
                                <h6> Επώνυμο:</h6> 
                                <input  id="surname" name="surname" type="text">
                            </div>
                            <div class="col-2">
                                <h6> Επωνυμία Εταιρίας:</h6> 
                                <input  id="company_name" name="company_name" type="text">
                            </div>
                    </div>
                    <br>
                    <div class="row">
                            <div class="col-4">
                                <h6> Δραστηριότητα Εταιρίας:</h6> 
                                <input style="width: 85%;" id="type" name="type" type="text">
                            </div>
                            
                    </div>
                    <br>
                    <div class="row">
                            <div class="col-2">
                                <h6> Τηλέφωνο:</h6> 
                                <input  id="phone" name="phone" type="text">
                            </div>
                            <div class="col-2">
                                <h6> E-mail:</h6> 
                                <input  id="mail" name="mail" type="text">
                            </div>
                            
                    </div>
                    <br>
                    <div class="row">
                            <div class="col-2">
                                <h6> Πόλη:</h6> 
                                <input  id="city" name="city" type="text">
                            </div>
                            <div class="col-2">
                                <h6> Διεύθυνση:</h6> 
                                <input  id="address" name="address" type="text">
                            </div>
                            <div class="col-2">
                                <h6> Τ.Κ.:</h6> 
                                <input  id="tk" name="tk" type="text">
                            </div>
                            <div class="col-2">
                                <h6> Δ.Ο.Υ.:</h6> 
                                <input  id="doy" name="doy" type="text">
                            </div>
                    </div>
                    <br>
                    <div class="row">
                            <div class="col-2">
                                <h6> Username:</h6> 
                                <input  id="username" name="username" type="text">
                            </div>
                            <div class="col-2">
                                <h6> Password:</h6> 
                                <input  id="password" name="password" type="text">
                            </div>
                            
                    </div>
                    <br>
                    <div class="row">
                            <div class="col-2">
                                <h6> Κοντινότερη πόλη στο OpenWeather:</h6> 
                                <input  id="opwc" name="opwc" type="text">
                               
                            </div>
                    </div>
                    <br>
                    <div class="row">
                            <div class="col-2">
                                <button type="submit" id="create_button1" name="create_button1" class="btn2" ><i class="fa fa-paint-brush"></i> Δημιουργία</button>
                            </div>
                    </div>
                </form>    
            </div>

            <div class="container-fluid" style="width:80%">
                <h2>Εισαγωγή αισθητήρα σε πελάτη</h2>
                <form action="Admin_Create.php" method="POST">
                        <div class="row">
                                <div class="col-2">
                                    <h6> Αναγνωριστικό συσκευής από TTS:</h6> 
                                    <input  id="dev" name="dev" type="text">
                                </div>
                                <div class="col-2">
                                    <h6> Τύπος Αισθητήρα:</h6> 
                                    <select id="types" name="types" >
                                        <option disabled selected value> --Επέλεξε-- </option>
                                        <option value="field" name="st"> Αισθητήρας Εδάφους</option>
                                        <option value="meteo" name="st"> Μετεωρολογικός Σταθμός</option>
                                                     
                                </select> 
                                </div>
                                <div class="col-2">
                                    <h6> Επέλεξε Πελάτη:</h6> 
                                    <select name="client_new" id="client_new" onchange='changeclient(this)'>
                                    
                                    <?php
                                       // <option disabled selected value> --Επέλεξε-- </option>
                                        $query6 = "SELECT DISTINCT parcel.ID_AFM2,person.NAME, person.SURNAME FROM parcel
                                                    INNER JOIN person ON person.ID_AFM= parcel.ID_AFM2";
                                        $result6 = mysqli_query($link,$query6);
                                        
                                        while($data = mysqli_fetch_array($result6))
                                        {           
                                        
                                            $client = $data['ID_AFM2'];
                                            $c_name=$data['NAME'];
                                            $c_surname=$data['SURNAME'];
                                            echo" <option value=".$client.">".$client." - ".$c_name." ".$c_surname."</option>";
                                        }    
                                       
                    
                                    ?> 
                                    </select> 
                                    </div>
                        </div>
                        <br>
                        <div class="row">  
                            <div class="col-2">
                                <button type="button" style="height: 70px;width: 150px;" class="btn2" onclick="document.getElementById('Map').style.width = '650px';document.getElementById('Map').style.height = '650px';init()"><i class="fa fa-map"></i> Εμφάνισε Χάρτη</button> 
                            </div>
                            <div class="col-2">
                                <button type="button" style="height: 70px;width: 150px;" class="btn" onclick="Remove()"><i class="fa fa-map"></i> Κρύψε Χάρτη</button> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2" id="test">
                                <div id="Map"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                                <div class="col-2">
                                    <h6> Γεωγραφικό πλάτος:</h6> 
                                    <input  id="lat" name="lat" type="text">
                                </div>
                                <div class="col-2">
                                    <h6> Γεωγραφικό μήκος:</h6> 
                                    <input  id="long" name="long" type="text">
                                </div>
                                
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                                <button type="submit" id="create_button2" name="create_button2" class="btn2" ><i class="fa fa-paint-brush"></i> Δημιουργία</button>
                            </div>
                    </div>
                 </form>     
            </div>
            

            <div class="container-fluid" style="width:80%">
                <h2>Εισαγωγή καινούριου προϊόντος</h2>
                <form action="Admin_Create.php" method="POST">
                    <div class="row">
                                <div class="col-2">
                                    <h6> Όνομα προϊόντος:</h6> 
                                    <input  id="prod_n" name="prod_n" type="text">
                                </div>
                                <div class="col-4">
                                    <h6> Περιγραφή:</h6> 
                                    <input style="height: 60px;width: 100%;" id="desc" name="desc" type="text">
                                </div>
                    </div>   
                    <br>        
                    <div class="row">
                                <div class="col-2">
                                    <h6> Εταιρία Κατασκευής:</h6> 
                                    <input  id="comp" name="comp" type="text">
                                </div>
                                <div class="col-2">
                                    <h6> Τιμή:</h6> 
                                    <input  id="price" name="price" type="text">
                                </div>
                                <div class="col-2">
                                
                                    <h6>Καλλιέργεια:</h6>
                                    <select id="crop" name="crop">
                                        <?php

                                            $query6 = "SELECT DISTINCT CROP_USED_IN FROM product";
                                            $result6 = mysqli_query($link,$query6);
                                            while($data = mysqli_fetch_array($result6))
                                            {           
                                            
                                                $crop_type = $data['CROP_USED_IN'];
                                                echo" <option value=".$crop_type.">".$crop_type."</option>";
                                            }    
                                            // Free result set
                                            mysqli_free_result($result6);
                                        ?> 
                                    </select>
                                
                                 </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <button type="submit" id="create_button3" name="create_button3" class="btn2" ><i class="fa fa-paint-brush"></i> Δημιουργία</button>
                            </div>
                        </div>
                </form> 


                <?php
                    if(isset($_POST['create_button1'])){

                        

                            $query ="INSERT INTO `person` (`ID_AFM`, `NAME`, `SURNAME`, `COMPANY_NAME`, `TYPE_OF_BUSSNESS`, `PHONE`, `EMAIL`, `CITY`, `ADDRESS`, `TK`, `DOY`, `USERNAME`, `PASSWORD`, `STATUS`, `CITYID_OWA`) 
                                        VALUES (".$_POST['afm'].", ".$_POST['name'].", ".$_POST['surname'].", ".$_POST['company_name'].", ".$_POST['type'].", ".$_POST['phone'].", ".$_POST['mail'].", ".$_POST['city'].", ".$_POST['address'].", ".$_POST['tk'].", ".$_POST['doy'].", ".$_POST['username'].", ".$_POST['password'].", 'client', ".$_POST['opwc'].");";
                             
                             if (mysqli_query($link, $query)) {
                                echo '<script language="javascript">';
                                echo 'alert("Νέα εργασία καταχωρίθηκε")';
                                echo '</script>';
                            } else {
                                echo '<script language="javascript">';
                                echo "console.log('Error:'". $query . mysqli_error($link).")";
                                echo '</script>';
                            }
                       
                    }
                    if(isset($_POST['create_button2'])){
                        $query ="INSERT INTO `sensor` (`ID_DEVICE`, `TYPE`, `LONGITUDE`, `LATITUDE`, `LAST_ACTIVE`) 
                        VALUES (".$_POST['dev'].", ".$_POST['types'].", ".$_POST['long'].", ".$_POST['lat'].", current_timestamp()); ";
                        $query2="INSERT INTO `person_has_sensor` (`ID_DEV`, `ID_P`) VALUES (".$_POST['dev'].", ".$_POST['client_new'].");";
                        
                        if (mysqli_query($link, $query)&&mysqli_query($link, $query2)) {
                            echo '<script language="javascript">';
                            echo 'alert("Νέα εργασία καταχωρίθηκε")';
                            echo '</script>';
                        } else {
                            echo '<script language="javascript">';
                            echo "console.log('Error:'". $query . $query2 . mysqli_error($link).")";
                            echo '</script>';
                        }

                    }
                    if(isset($_POST['create_button3'])){
                        $query ="INSERT INTO `product` (`ID`, `NAME`, `DESCRIPTION`, `COMPANY`, `PRICE`, `CROP_USED_IN`) 
                        VALUES (NULL, ".$_POST['prod_n'].", ".$_POST['desc'].", ".$_POST['comp'].", ".$_POST['price'].", ".$_POST['crop'].");";
                        if (mysqli_query($link, $query)) {
                            echo '<script language="javascript">';
                            echo 'alert("Νέα εργασία καταχωρίθηκε")';
                            echo '</script>';
                        } else {
                            echo '<script language="javascript">';
                            echo "console.log('Error:'". $query . mysqli_error($link).")";
                            echo '</script>';
                        }

                    }
                    



                    

                ?>















            </div>
            <br>

            <script>
                var map,vectorLayer,selectMarkerControl,selectedFeature;
                    var lat             =   40.329928;
                    var lon            =    23.147261;
                    var zoom        =   6;
                var curpos = new Array();
                var position;

                    var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
                    var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection

                    var cntrposition       = new OpenLayers.LonLat(lon, lat).transform( fromProjection, toProjection);

                
                function init()
                {
                        map = new OpenLayers.Map("Map",{
                                    controls: 
                                    [
                                                new OpenLayers.Control.PanZoomBar(),                        
                                    new OpenLayers.Control.LayerSwitcher({}),
                                    new OpenLayers.Control.Permalink(),
                                    new OpenLayers.Control.MousePosition({}),
                                    new OpenLayers.Control.ScaleLine(),
                                    new OpenLayers.Control.OverviewMap(),
                                            ]
                                    }
                                        );
                        var mapnik      = new OpenLayers.Layer.OSM("MAP"); 
                        var markers     = new OpenLayers.Layer.Markers( "Markers" );

                    map.addLayers([mapnik,markers]);
                    map.addLayer(mapnik);
                    map.setCenter(cntrposition, zoom);
                    
                    markers.addMarker(new OpenLayers.Marker(cntrposition));

                    var click = new OpenLayers.Control.Click();
                    map.addControl(click);

                    click.activate();
                    };

                    OpenLayers.Control.Click = OpenLayers.Class(OpenLayers.Control, {               
                    defaultHandlerOptions: {
                    'single': true,
                    'double': false,
                    'pixelTolerance': 0,
                    'stopSingle': false,
                    'stopDouble': false
                    },

                    initialize: function(options) {
                    this.handlerOptions = OpenLayers.Util.extend(
                    {}, this.defaultHandlerOptions
                    );
                    OpenLayers.Control.prototype.initialize.apply(
                    this, arguments
                    );
                    this.handler = new OpenLayers.Handler.Click(
                    this, {
                        'click': this.trigger
                    }, this.handlerOptions
                    );
                    },

                    trigger: function(e) {
                    var lonlat = map.getLonLatFromPixel(e.xy);
                    lonlat1= new OpenLayers.LonLat(lonlat.lon,lonlat.lat).transform(toProjection,fromProjection);

                    document.getElementById("lat").value = lonlat1.lat;
                    document.getElementById("long").value = lonlat1.lon;
                

                    }

                    });

                    function Remove() {
                        const element = document.getElementById("Map");
                        element.remove();

                        
                        
                                                }     
            </script>
     <div class=" container text-center ">
        <p>&copy; Developed by Theodorou Dimitris </p>
    </div>         
    </body>
</html>