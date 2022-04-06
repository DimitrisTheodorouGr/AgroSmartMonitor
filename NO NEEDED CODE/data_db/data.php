<?php 
header('Location: ../User.php');

?>
<?php 
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'farm_db2');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

if(isset($_POST['sensors'])){
  $sen = $_POST['sensors'];
  
}
if(!empty($_POST['sensors']))
{  
    //query to get data from the table
    //$query = sprintf("SELECT   `HUMIDITY_AIR`, `TEMPERATURE_AIR`, `MOISTURE_GRD`, `TEMPERATURE_GRD_50CM`, `TEMPERATURE_GRD_100CM`, `LEAF_WEATNESS`, `PHOTOSENSOR` ,`V_Timestamp` FROM `s_values` ");
    $query = sprintf("SELECT   `HUMIDITY_AIR`, `TEMPERATURE_AIR`, `MOISTURE_GRD`, `TEMPERATURE_GRD_50CM`, 
    `TEMPERATURE_GRD_100CM`, `LEAF_WEATNESS`, `PHOTOSENSOR` ,`V_Timestamp` FROM `s_values` WHERE DEVICE = '". $sen ."' ");

    //execute query
    $result = $mysqli->query($query);

    //loop through the returned data
    $data = array();
    foreach ($result as $row) {
      $data[] = $row;
    }

    //free memory associated with result
    $result->close();

    //close connection
    $mysqli->close();

    //now print the data
    print json_encode($data);

    
}
?>


