<?php
include('../include/db.php');

if (isset($_POST['save'])) {
    $city_name = $_POST['city_name'];
    $country_id = $_POST['country_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO cities (city_name, country_id, status, created_at) 
            VALUES ('$city_name', '$country_id', '$status', NOW())";

    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=City added successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$countries = $conn->query("SELECT country_id, country_name FROM countries");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add City</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Add New City</h2>
        <form method="POST">
            
            <div class="form-group mb-3">
                <label>City Name</label>
                <input type="text" name="city_name" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Country</label>
                <select name="country_id" class="form-control" required>
                    <option value="">-- Select Country --</option>
                    <?php while ($c = $countries->fetch_assoc()): ?>
                        <option value="<?= $c['country_id'] ?>"><?= $c['country_name'] ?></option>
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
