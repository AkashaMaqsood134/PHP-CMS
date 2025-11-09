<?php
include('../include/db.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $sql = "DELETE FROM cities WHERE city_id = $id";

    if($conn ->query($sql)){
       header("Location: ../tables.php?success=city deleted successfully!");
       exit;
        mysqli_close($conn);

    }
    else{
    echo "Error: " . $conn ->Error;
}
}else{
    echo "No id found!";
}
?>