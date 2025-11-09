<?php
include('../include/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM countries WHERE country_id = {$id}";
    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=Country deleted successfully");
        exit;
        mysqli_close($conn);
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID provided!";
}
?>
