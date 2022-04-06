<html>
    <head>
        <meta charset='utf-8'>
        <title>Agro Smart Monitor</title>
       
        
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
                    $data = mysqli_fetch_array($result1);
                    $user = $data['USERNAME'];
                    $role = $data['STATUS'];

                    
                }

               
                //Admin Interface
                //if the id exists in the database then redircet the user to the interface
                if($role == 'admin')
                {   echo '<script language="javascript">alert(" Welcome Admin ");</script>';    
                    echo '<script language="javascript">document.location="Admin.php";</script>';    
                }//end if Admin interface
                else if($role =='client')
                {
                    echo '<script language="javascript">alert(" Welcome Client");</script>';   
                    echo '<script language="javascript">document.location="User.php";</script>';   
                }
                else
                {
                    echo '<script language="javascript">document.location=" Error.php";</script>'; 
                }
                
                
               
        ?>
            

    </body>
</html>