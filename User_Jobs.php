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
                width:400px; 
                height:35px;
                font-family: Arial;
                border-color: grey ;
            }
        </style>
     
        
 
    </head>
    <body>
    
        <?php
        //
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
                            <a class="nav-link" href="User_Home.php">Αρχική</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="User_Jobs.php">Εργασίες</a>
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
            <br>
            <div class="container-fluid" style="width: 90%;">
              
              <h2>Οι εργασίες μου</h2>
                <div class="container">
                        
                    <form action="User_Jobs.php" method="POST">
                        <div class="row">
                                <div class="col-4">
                                    <h6> Επέλεξε κατάσταση:</h6>
                                    
                                    <select name="stat" id="stat" >
                                        <option value="ΕΓΙΝΕ" name="st"> Έγινε</option>
                                        <option value="ΣΕ ΕΞΕΛΙΞΗ" name="st"> Σε εξέληξη</option>
                                        <option value="ΔΕΝ ΕΓΙΝΕ" name="st"> Δεν έγινε</option>              
                                    </select> 
                                </div>
                                <div class="col-4">
                                    <h6> Επέλεξε σπουδαιότητα:</h6>
                                    <select name="urgen" id="urgen" >
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
                                    <label for="date_from">Εώς:</label> 
                                    <input type="date" id="date_to" name="date_to">
                                </div>

                        </div>    
                        <br>
                        <div class="row">
                            <div>
                                    <h6>Γρήγορες Επιλογές:</h6>
                                    
                                    <input type="radio" id="day_button" name="quick_button" value= "day">
                                    <label for="day_button"> Εργασίες ημέρας</label> 
                                    
                                    <input type="radio" id="week_button" name="quick_button" value= "week">
                                    <label for="week_button">Εργασίες εβδομάδας</label> 
                                    
                                    <input type="radio" id="month_button" name="quick_button" value= "month">
                                    <label for="month_button">Εργασίες μήνα</label>
                            </div>
                        </div>        
                        <br> <br>      
                        <div class="row">
                            <div class="col">

                                <input type="submit" id="show_button" value="Επιλογή">
                            </div>
                        </div>
                    
                    </form>
                </div>         
              <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                        <th>Ημερομηνία</th>
                        <th>Εργασία</th>
                        <th>Αργοτεμάχιο</th>
                        <th>Κατάσταση</th>
                        <th>Σπουδαιότητα</th>
                        <th>Προϊόν που χρησημοποιήθηκε</th>
                        <th>Κόστος προϊόντος</th>
                        <th>Κόστος εργασίας</th>
                        <th>Σημείωση</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  $query15 = "SELECT  jobs.J_TIMESTAMP , jobs.J_STATUS, jobs.ERGERNCY, job_uses_product.COST, product.NAME, product.NAME, product.PRICE FROM  job_uses_product  
                  INNER JOIN jobs ON jobs.ID = job_uses_product.ID_JOBS  
                  INNER JOIN product ON product.ID = job_uses_product.ID_PRODUCT 
                  WHERE  job_uses_product.ID_JOBS IN (SELECT jobs.ID FROM jobs WHERE jobs.ID_AFM  = '". $id ."')";

                  $result15 = mysqli_query($link,$query15);
                  if($result15 = mysqli_query($link, $query15))
                  {
                      if(mysqli_num_rows($result15) > 0)
                      {   
                          for($x=0;$x<mysqli_num_rows($result15);$x++)
                          {
                              $row = mysqli_fetch_array($result15);
                              echo "<tr>";   
                               echo "<td>" . $row['J_TIMESTAMP'] . "</td>";
                               echo "<td>" . "</td>";
                               echo "<td>" . "</td>"; 

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
                                echo "<td>" . $row['J_STATUS'] . "</td>";
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
                               echo "<td>" .  "</td>";  
                               
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

    <div class=" container text-center fixed-bottom">
        <p>&copy; Developed by Theodorou Dimitris </p>
    </div>   
    
    </body>
</html>