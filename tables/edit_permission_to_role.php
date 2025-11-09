<?php
include('../include/db.php');

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID is missing!");
}

$result = $conn->query("SELECT * FROM role_has_permission WHERE id = $id");
if (!$result || $result->num_rows == 0) {
    die("Record not found!");
}
$record = $result->fetch_assoc();
$roles = $conn->query("SELECT role_id, role_name FROM roles");
$permissions = $conn->query("SELECT permission_id, permission_name FROM permissions");

if (isset($_POST['update'])) {
    $role_id = $_POST['role_id'];
    $permission_id = $_POST['permission_id'];

    $sql = "UPDATE role_has_permission 
            SET role_id = '$role_id', 
                permission_id = '$permission_id', 
                updated_at = NOW() 
            WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=Permission mapping updated successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Role Permission</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Edit Role-Permission Mapping</h2>

        <form method="POST">

            <div class="form-group mb-3">
                <label>Role</label>
                <select name="role_id" class="form-control" required>
                    <option value="">-- Select Role --</option>
                    <?php while ($r = $roles->fetch_assoc()): ?>
                        <option value="<?= $r['role_id'] ?>" 
                            <?= ($r['role_id'] == $record['role_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($r['role_name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Permission</label>
                <select name="permission_id" class="form-control" required>
                    <option value="">-- Select Permission --</option>
                    <?php while ($p = $permissions->fetch_assoc()): ?>
                        <option value="<?= $p['permission_id'] ?>" 
                            <?= ($p['permission_id'] == $record['permission_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['permission_name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Buttons -->
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="../tables.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
