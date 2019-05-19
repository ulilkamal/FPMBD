<!DOCTYPE HTML>
<html>
<head>
    <title>Index</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../style.css">
         
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
    <h1>Soal View 1 Ulil</h1>
        </div>
     
        <?php
            // include database connection
            include '../config/database.php';
            $quer = "describe palingsering";
            $result = $conn->prepare($quer);
            $result->execute();
            $n = $result->rowCount();

            // select all data
            $query = "SELECT * FROM palingsering";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // this is how to get number of rows returned
            $num = $stmt->rowCount();

            // link to create record form

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
 
</body>
</html>