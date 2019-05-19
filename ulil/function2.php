<!DOCTYPE HTML>
<html>
<head>

    <title>Update Data</title>
       
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../style.css">
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
        <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="btn-toolbar text-center well" >
            <h1>Function 2 Ulil</h1>
        </div>
      
        <?php

require '../config/database.php';

?>
<form  method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td></td>
            <td>
                <input type='submit' name='hitung' value='Hitung Ruangan Berproyektor' class='btn btn-primary' />
                <!-- <a href='index.php' class='btn btn-danger'>Back to read products</a> -->
            </td>
        </tr>
        <tr>
            <?php 
                if(isset($_POST['hitung'])){
             
                // include database connection
                include '../config/database.php';
             
                try{
                    // insert query
                    $query = "SELECT ruang_proy() as hasil;";
                    //prepare query for execution
                    $stmt = $conn->prepare($query);
                    $stmt->execute();

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);  
                    $value = $row['hasil'];
                    echo "<div class='alert alert-success'>Ruangan yang berproyektor ada ".$value.".</div>";
                }
                 
                // show error
                catch(PDOException $exception){
                    die('ERROR: ' . $exception->getMessage());
                }
            }
            ?>
        </tr>
    </table>
</form>
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