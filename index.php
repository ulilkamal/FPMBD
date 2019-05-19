<!DOCTYPE HTML>
<html>
<head>
    <title>Index</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="style.css">
         
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
 
</head>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">SEWA RUANG</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">INPUT</a></li>
      <li><a href="pertanyaan.php">OUTPUT</a></li>
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
    <h1>Daftar <?php 
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
            // include database connection
            include 'config/database.php';
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
            echo "</div>";

            ?>
            <form method="POST" name="test">
                <div style="float: right;">
            <select class="btn btn-default dropdown-toggle" data-toggle="dropdown" name='tabel' onchange="window.location.href='index.php?abc='+this.value">
            <?php
            while ($row =$res->fetch())
            {
                echo "<option value = '{$row['0']}'";
                echo ">{$row['0']}</option>";
            }
            ?>
            </select> </div></form>
            <?php
            $quer = "describe $namatabel";
            $result = $conn->prepare($quer);
            $result->execute();
            $n = $result->rowCount();
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            // if it was redirected from delete.php
            if($action=='deleted'){
                echo "<div class='alert alert-success'>Data dihapus.</div>";
            }

            // select all data
            $query = "SELECT * FROM $namatabel";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // this is how to get number of rows returned
            $num = $stmt->rowCount();

            // link to create record form
            echo "<a href='create.php?abc=$namatabel' class=' btn btn-primary btn-color btn-bg-color' aria-hidden='true'>Buat $namatabel baru</a>";

            //check if more than 0 record found
            if($num>0){

                

                echo "<table class='col-md-4 col-form-label text-md-right table table-hover table-responsive table-bordered'>";//start table
 
                    //creating our table heading
                    $result->execute();
                    echo "<tr>";
                        while ($row = $result->fetch()) {
                            if ($row["Field"] != "id") {
                                echo "<th>".$row["Field"]."</th>";
                            }
                        }
                        echo "<th></th>";
                    echo "</tr>";
                    
                    // retrieve our table contents
                    // fetch() is faster than fetchAll()
                    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        // extract row
                        // this will make $row['firstname'] to
                        // just $firstname only
                        
                        // creating new table row per record
                         echo "<tr>";
                                $j=0;
                                foreach ($row as $key => $value){
                                    if($j==0) {$namakolom=$key;$id = $value;$j++;}
                                    echo "<td>".$value."</td>";
                                }
                            echo "<td>";
                                
                                // we will use this links on next part of this post
                                echo "<a href='update.php?id={$id}&abc={$namatabel}&kid={$namakolom}' class='btn btn-warning m-r-1em'>Edit</a>";
                    
                                // we will use this links on next part of this post
                                echo "<a href='delete.php?id={$id}&abc={$namatabel}&kid={$namakolom}'  class='btn btn-danger'>Delete</a>";
                            echo "</td>";
                         echo "</tr>";
                    }
                
                // end table
                echo "</table>";
                
            }
            // if no records found
            else{
                echo "<div class='alert alert-danger'>No records found.</div>";
            }
        ?>

     </div>
     </div>
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<script type='text/javascript'>
// confirm record deletion
function delete_user( id, namatabel, namakolom ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?abc='+namatabel+'&id=' + id + '&kid=' + namakolom;
    } 
}
</script>
 
</body>
</html>