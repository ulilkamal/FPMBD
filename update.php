<!DOCTYPE HTML>
<html>
<head>

    <title>Update Data</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
        <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="btn-toolbar text-center well" >
            <h1>Update <?php 
            if(isset($_GET['abc']))
            {
                echo $_GET['abc'];
            }
            else
            {
                echo "Denda";
            }
            ?></h1>
        </div>
      
        <?php

require 'config/database.php';
$queryo = "SHOW TABLES";
$res = $conn->prepare($queryo);
$res->execute();
if(isset($_GET['abc']))
{
    $namatabel=$_GET['abc'];

}
else
{
    $namatabel="denda";
}
if(isset($_GET['id']))
{
    $idnya=$_GET['id'];
}
if(isset($_GET['kid']))
{
    $kidnya=$_GET['kid'];
}

$quer = "describe $namatabel";
$result = $conn->prepare($quer);
//$result = $conn->query("describe $namatabel");
$result->execute();
$n = $result->rowCount();
if(isset($_POST['update'])){
 
    // include database connection
    include 'config/database.php';
 
    try{
        // insert query
        $a_params=array();
        $i=0;
        $query = "UPDATE ".$namatabel." SET ";
        $result->execute();
        while ($row = $result->fetch()) {
            if ($row["Field"] != "id") {
                $wow=$row["Field"];
                $a_params[$i] = htmlspecialchars(strip_tags($_POST[$wow]));
                $query .= $row["Field"]."=?, ";
                $i++;
            }
        }
        $query = substr($query,0,-2);
        $query .= " WHERE $kidnya=?";
        $a_params[$i]=$idnya;
 
        //prepare query for execution
        $stmt = $conn->prepare($query);
        

        // $i=1;
        
        // while ($row = $result->fetch()) {
        //     if ($row["Field"] != "id") {
        //         $wow=$row["Field"];
        //         $temp = htmlspecialchars(strip_tags($_POST[$wow]));
        //         $stmt->bindParam($i, $temp);
        //         $i++;
        //     }
        // }
        
        // // specify when this record was inserted to the database
        // $created=date('Y-m-d H:i:s');
        // $stmt->bindParam(':created', $created);
         
        // Execute the query
        if($stmt->execute($a_params)){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
$form = "<form method=\"post\">";
$selectnya = "SELECT * FROM $namatabel WHERE $kidnya = ?";
$results = $conn->prepare($selectnya);
$results -> bindParam(1,$idnya);
$results->execute();
if ($n > 0) {
    // output data of each row
    $isi=array();
    $l=0;
    while ($rows = $results->fetch(PDO::FETCH_ASSOC)) {
        foreach ($rows as $key => $value){
            $isi[$l]=$value;
            $l++;
        }
    }
    $l=0;
    while ($row = $result->fetch()) {
        if ($row["Field"] != "id") {
            $form .= "<div class='form-group'>";
            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label> <input type='text' class='form-control' name='" . $row["Field"] . "' value='".$isi[$l]."' >";
            $form .= "</div>";
            $l++;
        }
    }
    $form .= "<input type='submit' name='update' value='Update' class='btn btn-primary'>
                <a href='index.php?abc=$namatabel' class='btn btn-danger'>Back to List</a>
                </form>";
}

echo $form;
?>
    </div>
    </div>
    </div> 
    </div> <!-- end .container -->
      
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>