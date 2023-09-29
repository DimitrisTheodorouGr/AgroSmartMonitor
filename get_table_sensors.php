     <?php            
      require 'config.php';  
        //takes ID;
        session_start();
        $id = $_SESSION['ID_AFM'];

                echo " <table id=\"myTable\" class=\"table table-striped table-bordered\" style=\"width:100%\">";
                echo "              <thead>";
                    echo "              <tr>";
                    echo "                <th>Αισθητήρας</th>";
                    echo "                <th>Ενεργός τελευταία φορά </th>";
                    echo "               </tr>";
                echo "              </thead>";
                echo "              <tbody>";
                               
                                
                                $query15 = "SELECT `ID_DEVICE`, `LAST_ACTIVE` FROM `sensor` 
                                WHERE ID_DEVICE IN (SELECT `ID_DEV` FROM `person_has_sensor` WHERE ID_P = '". $id ."')";
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
                                    
                                
                echo "         </tbody>";
                echo "     </table>";
                            
        ?>