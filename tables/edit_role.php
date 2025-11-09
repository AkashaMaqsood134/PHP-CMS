<?php
include('../include/db.php');

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Role ID is missing!");
}

$result = $conn->query("SELECT * FROM roles WHERE role_id = $id");
$role = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $role_name = $_POST['role_name'];
    $status = $_POST['status'];

    $sql = "UPDATE roles SET role_name='$role_name', status='$status', updated_at=NOW() WHERE role_id=$id";
    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=Role updated successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Role</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Edit Role</h2>
        <form method="POST">
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" name="role_name" class="form-control" value="<?php echo $role['role_name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" <?php if ($role['status']) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if (!$role['status']) echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="tables.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
