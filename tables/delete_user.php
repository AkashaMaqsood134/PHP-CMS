<?php
include("../include/db.php");

if(isset($_GET['id'])){
$id = $_GET['id'];

$sql = "DELETE FROM users WHERE user_id = $id";


if($conn->query($sql)){
    header("Location: ../tables.php?success=user deleted successfully!");
    exit;
    mysqli_close($conn);
}
else{
    echo "Error: ".$conn->Error;
}
}
else{
    echo "No id found!";
}
?>