<?php
include('../include/db.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    die("User ID is missing!");
}

$result = $conn->query("SELECT * FROM users WHERE user_id = $id");
$roles = $conn->query("SELECT role_id, role_name FROM roles");
$countries = $conn->query("SELECT country_id, country_name FROM countries");
$cities = $conn->query("SELECT city_id, city_name FROM cities");
$states = $conn->query("SELECT state_id, state_name FROM states");
$user = $result->fetch_assoc();

if(isset($_POST['update'])){
  $user_name = $_POST['user_name'];
  $role_id = $_POST['role_id'];
  $phone = $_POST['phone_no'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $country_id = $_POST['country_id'];
  $city_id = $_POST['city_id'];
  $state_id = $_POST['state_id'];
  $status = $_POST['status'];

$sql = "UPDATE users SET user_name='$user_name',  role_id = '$role_id', 
        phone_no = '$phone', email = '$email', address = '$address', country_id = '$country_id',
        city_id='$city_id', state_id = '$state_id', status='$status', updated_at=NOW() 
            WHERE user_id=$id"; 


 if ($conn->query($sql)) {
        header("Location: ../tables.php?success=user updated successfully!");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
<div class="container">
    <h2 class="mb-4">Edit User</h2>
    <form method="POST">
        <div class="form-group mb-3">
            <label>User Name</label>
            <input type="text" name="user_name" class="form-control" required value="<?= $user['user_name'] ?>">
        </div>

        <div class="form-group mb-3">
            <label>Role</label>
            <select name="role_id" class="form-control" required>
                <option value="">-- Select Role --</option>
                <?php while ($r = $roles->fetch_assoc()): ?>
                    <option value="<?= $r['role_id'] ?>" <?= ($r['role_id'] == $user['role_id']) ? 'selected' : '' ?>>
                        <?= $r['role_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Phone No</label>
            <input type="text" name="phone_no" class="form-control" required value="<?= $user['phone_no'] ?>">
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control" required value="<?= $user['email'] ?>">
        </div>

        <div class="form-group mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required value="<?= $user['address'] ?>">
        </div>

        <div class="form-group mb-3">
            <label>Country</label>
            <select name="country_id" class="form-control" required>
                <option value="">-- Select Country --</option>
                <?php while ($co = $countries->fetch_assoc()): ?>
                    <option value="<?= $co['country_id'] ?>" <?= ($co['country_id'] == $user['country_id']) ? 'selected' : '' ?>>
                        <?= $co['country_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>City</label>
            <select name="city_id" class="form-control" required>
                <option value="">-- Select City --</option>
                <?php while ($ci = $cities->fetch_assoc()): ?>
                    <option value="<?= $ci['city_id'] ?>" <?= ($ci['city_id'] == $user['city_id']) ? 'selected' : '' ?>>
                        <?= $ci['city_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>State</label>
            <select name="state_id" class="form-control" required>
                <option value="">-- Select State --</option>
                <?php while ($st = $states->fetch_assoc()): ?>
                    <option value="<?= $st['state_id'] ?>" <?= ($st['state_id'] == $user['state_id']) ? 'selected' : '' ?>>
                        <?= $st['state_name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" <?= ($user['status'] == 1) ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= ($user['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="../tables.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>