<?php
include('../include/db.php');

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Country ID is missing!");
}

$result = $conn->query("SELECT * FROM countries WHERE country_id = $id");
$country = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $country_name = $_POST['country_name'];
    $status = $_POST['status'];

    $sql = "UPDATE countries SET country_name='$country_name', status='$status', updated_at=NOW() WHERE country_id=$id";
    if ($conn->query($sql)) {
        header("Location: ../tables.php?success=Countries updated successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Country</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Edit Country</h2>
        <form method="POST">
            <div class="form-group">
                <label>Country Name</label>
                <input type="text" name="country_name" class="form-control" value="<?php echo $country['country_name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" <?php if ($country['status']) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if (!$country['status']) echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="../tables.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
