<!DOCTYPE HTML>
<html>
<head>

    <title>Function 1 Ulil</title>
       
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
            <h1>Function 1 Ulil</h1>
        </div>
      
        <?php

require '../config/database.php';
if(isset($_POST['cek'])){
 
    // include database connection
    include '../config/database.php';
 
    try{
        // insert query
        $query = "SELECT cek(:ruang,:tanggal,:mulai,:selesai) as hasil";
        //prepare query for execution
        $stmt = $conn->prepare($query);
        $ruang = htmlspecialchars(strip_tags($_POST['ruang']));
        $tanggal = htmlspecialchars(strip_tags($_POST['tanggal']));
        $mulai = htmlspecialchars(strip_tags($_POST['mulai']));
        $selesai = htmlspecialchars(strip_tags($_POST['selesai']));
        
        $stmt->bindParam(':ruang', $ruang);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->bindParam(':mulai', $mulai);
        $stmt->bindParam(':selesai', $selesai);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);  
        $value = $row['hasil'];
        if($value==0) echo "<div class='alert alert-danger'>Ruangan Terisi.</div>";
        else if ($value==1) echo "<div class='alert alert-success'>Ruangan Kosong.</div>";
        
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
<form  method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Ruang</td>
            <td><input type='text' name='ruang' class='form-control' /></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td><input type='text' name='tanggal' class='form-control' /></td>
        </tr>
        <tr>
            <td>Jam Mulai</td>
            <td><input type='text' name='mulai' class='form-control' /></td>
        </tr>
        <tr>
            <td>Jam Selesai</td>
            <td><input type='text' name='selesai'  class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' name='cek' value='cek' class='btn btn-primary' />
                <!-- <a href='index.php' class='btn btn-danger'>Back to read products</a> -->
            </td>
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