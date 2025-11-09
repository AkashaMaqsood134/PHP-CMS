<?php
include('../include/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM permissions WHERE permission_id = {$id}";
    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=permission deleted successfully");
        exit;
        mysqli_close($conn);
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID provided!";
}
?>
