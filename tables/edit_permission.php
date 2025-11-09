<?php
include('../include/db.php');

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Permission ID is missing!");
}

$result = $conn->query("SELECT * FROM permissions WHERE permission_id = $id");
$permission = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $permission_name = $_POST['permission_name'];
    $status = $_POST['status'];

    $sql = "UPDATE permissions SET permission_name='$permission_name', status='$status', updated_at=NOW() WHERE permission_id=$id";
    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=Permissions updated successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Permission</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Edit Permission</h2>
        <form method="POST">
            <div class="form-group">
                <label>Permission Name</label>
                <input type="text" name="permission_name" class="form-control" value="<?php echo $permission['permission_name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" <?php if ($permission['status']) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if (!$permission['status']) echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="tables.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
