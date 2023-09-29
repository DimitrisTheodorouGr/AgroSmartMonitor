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
                            <a class="nav-link" href="Admin_Home.php">Αρχική</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Admin_Jobs.php">Εργασίες</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="Admin_Create.php">Προσθήκη</a>
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
            <div class="container-fluid" style="width: 90%;">
              
                <div class="container-fluid">
                    <h4> Εύρεση εργασίας:</h4> 
                    <form action="Admin_Jobs.php" method="POST">
                        <div class="row">
                                <div class="col-2">
                                    <h6> Επέλεξε κατάσταση:</h6> 
                                    <select name="stat" id="stat" >
                                        <option disabled selected value> --Επέλεξε-- </option>
                                        <option value="ΕΓΙΝΕ" name="st"> Έγινε</option>
                                        <option value="ΣΕ ΕΞΕΛΙΞΗ" name="st"> Σε εξέλιξη</option>
                                        <option value="ΔΕΝ ΕΓΙΝΕ" name="st"> Δεν έγινε</option>              
                                    </select> 
                                </div>
                                <div class="col-2">
                                    <h6> Επέλεξε σπουδαιότητα:</h6>
                                    <select name="urgen" id="urgen" >
                                        <option disabled selected value> --Επέλεξε-- </option>
                                        <option value="ΥΨΗΛΗ" name="ur"> Υψηλή</option>
                                        <option value="ΜΕΤΡΙΑ" name="ur"> Μέτρια</option>
                                        <option value="ΧΑΜΗΛΗ" name="ur"> Χαμηλή</option>              
                                    </select> 
                                </div>
                        </div>
                        <br>
                        <div class="row">
                                <h6>Επέλεξε ημερομηνία:</h6><br>
                                <div class="col-2">
                                    <label for="date_from">Από:</label> 
                                    <input type="date" id="date_from" name="date_from">
                                </div>
                                <div class="col-2">
                                    <label for="date_from"> Εώς:</label> 
                                    <input type="date" id="date_to" name="date_to">
                                </div>
                        </div>    
                        <br>
                               
                        <br>      
                        <div class="row">
                            <div class="col">
                                <button type="submit" id="show_button" name="show_button" class="btn2" ><i class="fa fa-search"></i> Εύρεση</button>
                                
                            </div>
                        </div>
                    
                    </form>
                </div> 
                <div class="container-fluid">
                    <h4> Δημιουργία εργασίας:</h4> 
                    <form action="Admin_Jobs.php" method="POST">
                        <div class="row">
                                <div class="col-2">
                                <h6>Επέλεξε ημερομηνία:</h6>  
                                    <input type="date" id="date_new" name="date_new" style="height:35px;">
                                </div>
                                <div class="col-2">
                                    <h6> Επέλεξε τύπο εργασίας:</h6> 
                                    <select name="type_new" id="type_new" >
                                        <option disabled selected value> --Επέλεξε-- </option>
                                        <option value="ΡΑΝΤΙΣΜΟΣ" name="tp">Ραντισμός</option>
                                        <option value="ΛΙΠΑΝΣΗ" name="tp">Λίπανση</option>
                                        <option value="ΚΛΑΔΕΜΑ" name="tp">Κλάδεμα</option>              
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
                                <div class="col-2">
                                    <h6> Επέλεξε αγροτεμάχιο:</h6> 
                                    <select name="field_new" id="field_new">
                                    
                                    <?php
                                    $query6 = "SELECT * FROM `parcel`";
                                    $result6 = mysqli_query($link,$query6);

                                    while($data = mysqli_fetch_array($result6))
                                    {           
                                    
                                        $field_id = $data['ID'];
                                        $client_id2 = $data['ID_AFM2'];
                                        $field_location = $data['LOCATION'];
                                        $crop2= $data['CROP'];
                                        $morgen=$data['MORGEN'];
                                      
                                        if($client_id2=='801324922'){
                                           echo"<option name='$client_id2' value=".$field_id." >".$field_location." ".$crop2." ".$morgen." στρ"."</option>";
                                             
                                        }
                                        else{
                                            echo"<option style='display:none' name='$client_id2' value=".$field_id." >".$field_location." ".$crop2." ".$morgen." στρ"."</option>";
                                        }
                                            
                                    
                                    }
                  
                                    ?> 
                                    </select> 
                                </div>
                                
                                
                                <div class="col-2">
                                    <h6> Επέλεξε κατάσταση:</h6> 
                                    <select name="stat_new" id="stat_new" >
                                        <option disabled selected value> --Επέλεξε-- </option>
                                        <option value="ΕΓΙΝΕ" name="st"> Έγινε</option>
                                        <option value="ΣΕ ΕΞΕΛΙΞΗ" name="st"> Σε εξέλιξη</option>
                                        <option value="ΔΕΝ ΕΓΙΝΕ" name="st"> Δεν έγινε</option>              
                                    </select> 
                                </div>
                                <div class="col-2">
                                    <h6> Επέλεξε σπουδαιότητα:</h6>
                                    <select name="urgen_new" id="urgen_new" >
                                        <option disabled selected value> --Επέλεξε-- </option>
                                        <option value="ΥΨΗΛΗ" name="ur"> Υψηλή</option>
                                        <option value="ΜΕΤΡΙΑ" name="ur"> Μέτρια</option>
                                        <option value="ΧΑΜΗΛΗ" name="ur"> Χαμηλή</option>              
                                    </select> 
                                </div> 

                        </div> 
                        <br>
                        <div class="row">
                                <div class="col-2">
                                
                                    <h6>Καλλιέργεια:</h6>
                                    <select id="id_crop" name="id_crop" onchange='changecrop(this)' >
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
                                <div class="col-3">
                                    <h6> Επέλεξε προϊόν που χρησημοποιήθηκε:</h6> 
                                    <select name="product_new" id="product_new">
                                    
                                    <?php
                                        
                                        $query6 = "SELECT * FROM `product`";
                                        $result6 = mysqli_query($link,$query6);
 
                                        while($data = mysqli_fetch_array($result6))
                                        {           
                                        
                                            $product_name = $data['NAME'];
                                            $product_id = $data['ID'];
                                            $crop= $data['CROP_USED_IN'];
                                            $product_cost=$data['PRICE'];
                                          
                                            if($crop=='Ελιά'){
                                               echo"<option name='$crop' value=".$product_id." >".$product_name." Τιμή/τμχ.: ".$product_cost." &euro;"."</option>";
                                                 
                                            }
                                            else{
                                                echo"<option style='display:none' name='$crop' value=".$product_id." >".$product_name." Τιμή/τμχ.: ".$product_cost." &euro;"."</option>";
                                            }
                                                
                                        
                                        }
                                            // Free result set
                                            mysqli_free_result($result6);
                                         
                                        
                    
                                    ?> 
                                    </select> 
                                </div>
                               
                                <div class="col-3">
                                    <h6> Εισάγετε ποσότητα προϊόντος:</h6> 
                                    <input style=" height:55%" id="product_amount" name="product_amount" type="number">
                                </div>
                                
                                <div class="col-2">
                                    <h6> Εισάγετε κόστος εργασίας:</h6> 
                                    <input style="height:55%" id="total_cost" name="total_cost" type="number">
                                </div>

                                <div class="col-2">
                                    <h6> Εισάγετε σημείωση:</h6> 
                                    <input style="height:55%;width:100%;" id="note" name="note" type="text">
                                </div>
                        </div>
                        
                        <br>
                        <br>
                                     
                        <div class="row">
                            <div class="col">
                                <button type="submit" id="create_button" name="create_button" class="btn2" ><i class="fa fa-paint-brush"></i> Δημιουργία</button>
                            </div>
                        </div>
                    
                    </form> 
                    <?php
                    if(isset($_POST['create_button'])){

                        //echo $_POST['type_new'].$_POST['date_new'].$_POST['stat_new'].$_POST['urgen_new'].$id."<br>FIELD:".$_POST['field_new']."<br>".$_POST['product_new'].$_POST['product_amount'].$_POST['total_cost'];
                        $query7 = "SELECT PRICE FROM `product` WHERE ID =".$_POST['product_new']. "";
                        $result7 = mysqli_query($link,$query7);
                        
                        if(mysqli_num_rows($result7) > 0)
                        {
                            $data = mysqli_fetch_array($result7);
                            $pr_price=$data['PRICE'];
                        }
                        //ΔΕΝ ΕΧΕΙ ΤΕΣΤΑΡΙΣΤΕΙ!!!!
                        if(!isset($_POST['product_amount'])){
                            $_POST['product_amount']= 0;
                        }

                        $final_cost= $pr_price * $_POST['product_amount'] + $_POST['total_cost'];

                        if ($_POST['product_amount']== 0) {

                            $query_cr1 ="INSERT INTO `jobs`(`ID`, `TYPE`, `J_TIMESTAMP`, `J_STATUS`, `ERGERNCY`, `ID_AFM`, `NOTE`, `ID_PARCEL`) VALUES (NULL,'".$_POST['type_new']."','".$_POST['date_new']."','".$_POST['stat_new']."','".$_POST['urgen_new']."','".$_POST['client_new']."','".$_POST['note']."',".$_POST['field_new'].");";
                            $query_cr2="INSERT INTO `job_uses_product` (`ID_PRODUCT`, `ID_JOBS`, `AMOUNT`, `COST`, `ID_PARCEL`,`TOTAL_COST`) VALUES ('0',( SELECT MAX(ID) FROM jobs WHERE jobs.ID_AFM ='".$_POST['client_new']."') , '".$_POST['product_amount']."', '".$_POST['total_cost']."',".$_POST['field_new'].",'".$final_cost."');";  

                        }else
                        {
                            //echo $final_cost;
                            $query_cr1 ="INSERT INTO `jobs`(`ID`, `TYPE`, `J_TIMESTAMP`, `J_STATUS`, `ERGERNCY`, `ID_AFM`, `NOTE`, `ID_PARCEL`) VALUES (NULL,'".$_POST['type_new']."','".$_POST['date_new']."','".$_POST['stat_new']."','".$_POST['urgen_new']."','".$_POST['client_new']."','".$_POST['note']."',".$_POST['field_new'].");";
                            $query_cr2="INSERT INTO `job_uses_product` (`ID_PRODUCT`, `ID_JOBS`, `AMOUNT`, `COST`, `ID_PARCEL`,`TOTAL_COST`) VALUES ('".$_POST['product_new']."',( SELECT MAX(ID) FROM jobs WHERE jobs.ID_AFM ='".$_POST['client_new']."') , '".$_POST['product_amount']."', '".$_POST['total_cost']."',".$_POST['field_new'].",'".$final_cost."');";
    
                        }
                        
                        
                        if (mysqli_query($link, $query_cr1)&&mysqli_query($link, $query_cr2)) {
                            echo '<script language="javascript">';
                            echo 'alert("Νέα εργασία καταχωρίθηκε")';
                            echo '</script>';
                        } else {
                            echo '<script language="javascript">';
                            echo "console.log('Error:'". $query_cr1 . $query_cr2 . mysqli_error($link).")";
                            echo '</script>';
                        }

                    }


                    ?>

                </div> 
                <hr> 


                <h2>Οι εργασίες μου</h2>   

                 <form action="Admin_Jobs.php" method="POST">
  
                    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th> </th>
                                <th>Ημερομηνία</th>
                                <th>Εργασία</th>
                                <th>Αργοτεμάχιο</th>
                                <th>Πελάτης</th>
                                <th>Κατάσταση</th>
                                <th>Σπουδαιότητα</th>
                                <th>Προϊόν που χρησημοποιήθηκε</th>
                                <th>Κόστος προϊόντος</th>
                                <th>Κόστος εργασίας</th>
                                <th>Συνολικό κόστος</th>
                                <th>Σημείωση(από εταιρία)</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                        if(isset($_POST['stat']))
                        {
                            $stat = $_POST['stat'];
                        }
                        if(isset($_POST['urgen']))
                        {
                            $urgen = $_POST['urgen'];
                        }
                        if(isset($_POST['date_from']))
                        {
                            $date_from = $_POST['date_from'];
                        }
                        if(isset($_POST['date_to']))
                        {
                            $date_to = $_POST['date_to'];
                        }

                        if(!empty($_POST['stat']) && empty($_POST['urgen']) && empty($_POST['date_from']) && empty($_POST['date_to']))
                        {
                            $query15 = "SELECT jobs.ID_AFM,jobs.ID, jobs.TYPE ,jobs.J_TIMESTAMP , jobs.J_STATUS, jobs.ERGERNCY, jobs.NOTE, job_uses_product.COST,job_uses_product.TOTAL_COST, product.NAME, product.PRICE, parcel.LOCATION,parcel.CROP, parcel.MORGEN
                            FROM  job_uses_product  
                            INNER JOIN jobs ON jobs.ID = job_uses_product.ID_JOBS  
                            INNER JOIN product ON product.ID = job_uses_product.ID_PRODUCT
                            INNER JOIN parcel ON parcel.ID = job_uses_product.ID_PARCEL 
                            WHERE  job_uses_product.ID_JOBS IN (SELECT jobs.ID FROM jobs WHERE  jobs.J_STATUS= '".$stat."')";


                        } 
                        elseif (!empty($_POST['urgen']) && empty($_POST['stat']) && empty($_POST['date_from']) && empty($_POST['date_to']))
                        {
                            $query15 = "SELECT jobs.ID_AFM, jobs.ID, jobs.TYPE ,jobs.J_TIMESTAMP , jobs.J_STATUS, jobs.ERGERNCY, jobs.NOTE, job_uses_product.COST,job_uses_product.TOTAL_COST, product.NAME, product.PRICE, parcel.LOCATION,parcel.CROP, parcel.MORGEN
                            FROM  job_uses_product  
                            INNER JOIN jobs ON jobs.ID = job_uses_product.ID_JOBS  
                            INNER JOIN product ON product.ID = job_uses_product.ID_PRODUCT
                            INNER JOIN parcel ON parcel.ID = job_uses_product.ID_PARCEL
                            WHERE  job_uses_product.ID_JOBS IN (SELECT jobs.ID FROM jobs WHERE  jobs.ERGERNCY= '".$urgen."')";

                        }
                        elseif (!empty($_POST['urgen']) && !empty($_POST['stat']) && empty($_POST['date_from']) && empty($_POST['date_to']))
                        {
                            $query15 = "SELECT jobs.ID_AFM,jobs.ID, jobs.TYPE ,jobs.J_TIMESTAMP , jobs.J_STATUS, jobs.ERGERNCY, jobs.NOTE, job_uses_product.COST,job_uses_product.TOTAL_COST, product.NAME, product.PRICE, parcel.LOCATION,parcel.CROP, parcel.MORGEN
                            FROM  job_uses_product  
                            INNER JOIN jobs ON jobs.ID = job_uses_product.ID_JOBS  
                            INNER JOIN product ON product.ID = job_uses_product.ID_PRODUCT
                            INNER JOIN parcel ON parcel.ID = job_uses_product.ID_PARCEL
                            WHERE  job_uses_product.ID_JOBS IN (SELECT jobs.ID FROM jobs WHERE  jobs.ERGERNCY= '".$urgen."' AND jobs.J_STATUS= '".$stat."')";

                        }
                        elseif ( empty($_POST['urgen']) && empty($_POST['stat']) && !empty($_POST['date_from']) && !empty($_POST['date_to']))
                        {
                            
                            //echo $date_from. $date_to;
                            $query15 = "SELECT jobs.ID_AFM, jobs.ID, jobs.TYPE ,jobs.J_TIMESTAMP , jobs.J_STATUS, jobs.ERGERNCY, jobs.NOTE, job_uses_product.COST,job_uses_product.TOTAL_COST, product.NAME, product.PRICE, parcel.LOCATION,parcel.CROP, parcel.MORGEN
                            FROM  job_uses_product  
                            INNER JOIN jobs ON jobs.ID = job_uses_product.ID_JOBS  
                            INNER JOIN product ON product.ID = job_uses_product.ID_PRODUCT
                            INNER JOIN parcel ON parcel.ID = job_uses_product.ID_PARCEL 
                            WHERE  job_uses_product.ID_JOBS IN (SELECT jobs.ID FROM jobs WHERE  J_TIMESTAMP BETWEEN '". $date_from . "' AND '". $date_to ."')";

                        }
                        else 
                        {
                        $query15 = "SELECT * FROM (SELECT  jobs.ID_AFM, jobs.ID, jobs.TYPE ,jobs.J_TIMESTAMP , jobs.J_STATUS, jobs.ERGERNCY, jobs.NOTE, job_uses_product.COST,job_uses_product.TOTAL_COST, product.NAME, product.PRICE, parcel.LOCATION,parcel.CROP, parcel.MORGEN  
                        FROM  job_uses_product  
                        INNER JOIN jobs ON jobs.ID = job_uses_product.ID_JOBS  
                        INNER JOIN product ON product.ID = job_uses_product.ID_PRODUCT
                        INNER JOIN parcel ON parcel.ID = job_uses_product.ID_PARCEL

                        WHERE  job_uses_product.ID_JOBS IN (SELECT jobs.ID FROM jobs) ORDER BY jobs.ID DESC LIMIT 5) var1 ORDER BY ID ASC";
        
                        }   echo "<form action=\"Admin_Jobs.php\" method=\"POST\">";
                            $result15 = mysqli_query($link,$query15);
                                if(mysqli_num_rows($result15) > 0)
                                {   
                                    for($x=0;$x<mysqli_num_rows($result15);$x++)
                                    {
                                        $row = mysqli_fetch_array($result15);
                                        echo "<tr>"; 
                                        echo "<td>"."<button type=\"submit\" id=\"delete_button\" name=\"delete_button\" class=\"btn\" value =".$row['ID']."><i class=\"fa fa-trash\"></i></button>" . "</td>";// checkbox cell
                                        echo "<td>" . $row['J_TIMESTAMP'] . "</td>";
                                        echo "<td>" .$row['TYPE']. "</td>";
                                        echo "<td>" .$row['CROP']." - ".$row['LOCATION']." ".$row['MORGEN']."στρ. "."</td>"; 
                                        echo "<td>" .$row['ID_AFM']. "</td>"; 

                                        if($row['J_STATUS'] == "ΕΓΙΝΕ")
                                        {
                                        echo "<td class=\"table-success\">" . $row['J_STATUS'] . "</td>"; 

                                        }
                                        else if($row['J_STATUS']=="ΔΕΝ ΕΓΙΝΕ" )
                                        {

                                        echo "<td class=\"table-danger\">" . $row['J_STATUS'] . "</td>"; 
                                        }
                                        else
                                        {
                                        echo "<td class=\"table-primary\" >" . $row['J_STATUS'] . "</td>";
                                        }

                                        if($row['ERGERNCY'] == "ΧΑΜΗΛΗ")
                                        {
                                        echo "<td class=\"table-success\">" . $row['ERGERNCY'] . "</td>"; 

                                        }
                                        else if($row['ERGERNCY']=="ΥΨΗΛΗ" )
                                        {

                                        echo "<td class=\"table-danger\">" . $row['ERGERNCY'] . "</td>"; 
                                        }
                                        else
                                        {
                                        echo "<td class=\"table-warning\">" . $row['ERGERNCY'] ."</td>";
                                        }
                                        
                                        echo "<td>" . $row['NAME'] . "</td>";  
                                        echo "<td>" . $row['PRICE'] . "</td>";
                                        echo "<td>" . $row['COST'] .  "</td>";
                                        echo "<td>" . $row['TOTAL_COST'] .  "</td>";
                                        echo "<td>" . $row['NOTE'] . "</td>";  
                                        
                                        echo "</tr>";
                                    } 
                                            // Free result set
                                            mysqli_free_result($result15);
                                } 
                                else 
                                {   
                                echo "<tr>";           
                                    echo "<td colspan=\"9\" style=\"text-align: center\"> ΔΕΝ ΥΠΑΡΧΟΥΝ ΔΕΔΟΜΕΝΑ </td>";  
                                echo "</tr>"; 
                                }
                        
                            
                        ?>
                        </tbody>
                    </table>
              
                </form>
           </div>
           <div>
           <?php
                    if(isset($_POST['delete_button'])){

                        //echo $_POST['delete_button'];
                        $query_dl1 ="DELETE FROM `job_uses_product` WHERE ID_JOBS ='".$_POST['delete_button']."';";
                        mysqli_query($link, $query_dl1);      

                        $query_dl2="DELETE FROM `jobs` WHERE ID ='".$_POST['delete_button']."';";
                        mysqli_query($link, $query_dl2);
                       
                        echo '<script language="javascript">';
                        echo 'location.reload();';
                        echo '</script>';


                   }


                    ?>
            


           </div>

    <div class=" container text-center">
        <p>&copy; Developed by Theodorou Dimitris </p>
    </div>   
    
    </body>

    <script> 
        function changecrop(x){
            //console.log(document.getElementsByName(x.value));
            var list =document.getElementsByName(x.value);
            var z = document.getElementById('product_new');

            for(var j=0;j<z.options.length;j++) {
                z.options[j].style.display = 'none';
            }  

            for(var i=0;i<list.length;i++){
                list[i].style.display= 'inline';
            }
            list[0].selected = true;     
        }
        function changeclient(x){
            console.log(document.getElementsByName(x.value));
            var list =document.getElementsByName(x.value);
            var z = document.getElementById('field_new');

            for(var j=0;j<z.options.length;j++) {
                z.options[j].style.display = 'none';
            }  

            for(var i=0;i<list.length;i++){
                list[i].style.display= 'inline';
            }
            list[0].selected = true;     
        }
    </script>
</html>