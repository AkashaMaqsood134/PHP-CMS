<?php
include ('../include/db.php');

if(isset($_POST['save'])){

    $role_id = $_POST['role_id'];
    $permission_id = $_POST['permission_id'];

    $sql = "INSERT INTO role_has_permission (role_id, permission_id, created_at) values ('$role_id', '$permission_id', Now())";
    if ($conn->query($sql)){
        header("Location: ../tables.php?success = Permission assigned to role successfully");
        exit;
    }
    else{
        echo "Error: " . $conn->error;
    }
    


} 

$roles = $conn->query("SELECT role_id, role_name FROM roles");

$permissions = $conn->query("SELECT permission_id, permission_name FROM permissions");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Permission to Role</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Assign Permission to Role</h2>
        <form method="POST">

            <div class="form-group mb-3">
                <label>Role</label>
                <select name="role_id" class="form-control" required>
                    <option value="">-- Select Role --</option>
                    <?php while ($r = $roles->fetch_assoc()): ?>
                        <option value="<?= $r['role_id'] ?>"><?= $r['role_name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Permission</label>
                <select name="permission_id" class="form-control" required>
                    <option value="">-- Select Permission --</option>
                    <?php while ($p = $permissions->fetch_assoc()): ?>
                        <option value="<?= $p['permission_id'] ?>"><?= $p['permission_name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" name="save" class="btn btn-primary">Save</button>
            <a href="../tables.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>