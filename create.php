<!DOCTYPE HTML>
<html>
<head>

    <title>Insert Data</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Insert <?php 
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
?>
<form method="POST" name="test">
<select name = 'tabel' onchange="window.location.href='create.php?abc='+this.value">
<?php
while ($row =$res->fetch())
{
    echo "<option value = '{$row['0']}'";
    echo ">{$row['0']}</option>";
}
?>
 </select> </form>
<?php
if(isset($_GET['abc']))
{
    $namatabel=$_GET['abc'];

}
else
{
    $namatabel="denda";
}

$quer = "describe $namatabel";
$result = $conn->prepare($quer);
//$result = $conn->query("describe $namatabel");
$result->execute();
$n = $result->rowCount();
if(isset($_POST['save'])){
 
    // include database connection
    include 'config/database.php';
 
    try{
        // insert query
        $a_params=array();
        $i=0;
        $query = "INSERT INTO ".$namatabel." SET ";
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
if ($n > 0) {
    // output data of each row
    while ($row = $result->fetch()) {
        if ($row["Field"] != "id") {
            $form .= "<div class='form-group'>";
            $form .= "<label for='" . $row["Field"] . "'>" . $row["Field"] . "</label> <input type='text' class='form-control' name='" . $row["Field"] . "' >";
            $form .= "</div>";
        }
    }
    $form .= "<input type='submit' name='save' value='Save'></form>";
}

echo $form;
?>
          
    </div> <!-- end .container -->
      
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>