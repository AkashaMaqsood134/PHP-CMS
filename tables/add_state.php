<?php
include('../include/db.php');

if (isset($_POST['save'])) {
    $state_name = $_POST['state_name'];
    $city_id = $_POST['city_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO states (state_name, city_id, status, created_at) 
            VALUES ('$state_name', '$city_id', '$status', NOW())";

    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=state added successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$cities = $conn->query("SELECT city_id, city_name FROM cities");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add State</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Add New State</h2>
        <form method="POST">
            
            <div class="form-group mb-3">
                <label>State Name</label>
                <input type="text" name="state_name" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>City</label>
                <select name="city_id" class="form-control" required>
                    <option value="">-- Select City --</option>
                    <?php while ($c = $cities->fetch_assoc()): ?>
                        <option value="<?= $c['city_id'] ?>"><?= $c['city_name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group mb-3">
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
