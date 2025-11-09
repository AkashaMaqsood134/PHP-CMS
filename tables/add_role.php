<?php
include('../include/db.php');

if (isset($_POST['save'])) {
    $role_name = $_POST['role_name'];
    $status = $_POST['status'];

    $sql = "INSERT INTO roles (role_name, status, created_at) VALUES ('$role_name', '$status', NOW())";
    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=Role added successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Role</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Add New Role</h2>
        <form method="POST">
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" name="role_name" class="form-control" required>
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
