<?php
// include database connection
include 'config/database.php';
 
try {
     
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $idnya=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    $namatabel=isset($_GET['abc']) ? $_GET['abc'] : die('ERROR: Record ID not found.');
    $namakolom=isset($_GET['kid']) ? $_GET['kid'] : die('ERROR: Record ID not found.');
 
    // delete query
    $query = "DELETE FROM $namatabel WHERE $namakolom=?;";
    //echo $query;
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $idnya);
     
    if($stmt->execute()){
        // redirect to read records page and 
        // tell the user record was deleted
        header('Location: index.php?abc='.$namatabel.'&action=deleted');
    }else{
        die('Tidak bisa menghapus, pastikan data tidak menjadi foreign key di table lain.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>