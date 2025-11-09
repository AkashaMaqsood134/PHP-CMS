<?php
include('../include/db.php');

if (isset($_POST['save'])) {
    $permission_name = $_POST['permission_name'];
    $status = $_POST['status'];

    $sql = "INSERT INTO permissions (permission_name, status, created_at) VALUES ('$permission_name', '$status', NOW())";
    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=Permission added successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Permission</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Add New Permission</h2>
        <form method="POST">
            <div class="form-group">
                <label>Permission Name</label>
                <input type="text" name="permission_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
            <a href="../tables.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
