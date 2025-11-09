<?php
include('../include/db.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    die("State ID is missing!");
}

$result = $conn->query("SELECT * FROM states WHERE state_id = $id");
$cities = $conn->query("SELECT city_id, city_name FROM cities");
$state = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $state_name = $_POST['state_name'];
    $city_id = $_POST['city_id'];
    $status = $_POST['status'];

    $sql = "UPDATE states 
            SET state_name='$state_name', city_id='$city_id', status='$status', updated_at=NOW() 
            WHERE state_id=$id";

    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=State updated successfully!");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit State</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Edit State</h2>
        <form method="POST">
            <div class="form-group">
                <label>State Name</label>
                <input type="text" name="state_name" class="form-control" 
                       value="<?php echo $state['state_name']; ?>" required>
            </div>

            <div class="form-group">
                <label>City</label>
                <select name="city_id" class="form-control">
                    <?php while ($c = $cities->fetch_assoc()): ?>
                        <option value="<?php echo $c['city_id']; ?>" 
                            <?php if ($c['city_id'] == $state['city_id']) echo 'selected'; ?>>
                            <?php echo $c['city_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" <?php if ($state['status']) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if (!$state['status']) echo 'selected'; ?>>Inactive</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="../tables.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
