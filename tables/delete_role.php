<?php
include('../include/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM roles WHERE role_id = {$id}";
    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=Role deleted successfully");
        exit;
        mysqli_close($conn);
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID provided!";
}
?>
