<!DOCTYPE HTML>
<html>
<head>

    <title>Function 1 Ihdiannaja</title>
       
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../style.css">
          
</head>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">SEWA RUANG</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/fpmbd/index.php">INPUT</a></li>
      <li><a href="/fpmbd/pertanyaan.php">OUTPUT</a></li>
    </ul>
  </div>
</nav>
<br>
<br>
<br>
<body>
  
    <!-- container -->
    <div class="container">
        <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="btn-toolbar text-center well" >
            <h1>Function 1 Ihdiannaja</h1>
        </div>
      
        <?php

require '../config/database.php';

?>
<form  method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td></td>
            <td>
                <input type='submit' name='hitung' value='Memotong Total Harga' class='btn btn-primary' />
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
                    $query = "SELECT potongan_harga() as hasil;";
                    //prepare query for execution
                    $stmt = $conn->prepare($query);
                    $stmt->execute();

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);  
                    $value = $row['hasil'];
                    echo "<div class='alert alert-success'>Memotong harga berhasil dilakukan ".$value.".</div>";
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