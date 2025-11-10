<?php
include('../include/db.php');

if(isset($_POST['save'])){
  $user_name = $_POST['user_name'];
  $role_id = $_POST['role_id'];
  $phone = $_POST['phone_no'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $country_id = $_POST['country_id'];
  $city_id = $_POST['city_id'];
  $state_id = $_POST['state_id'];
  $status = $_POST['status'];
 
  $sql = "INSERT INTO users (user_name, role_id, phone_no, email, address, country_id, city_id, state_id, status, created_at)
          VALUES ('$user_name', '$role_id', '$phone', '$email', '$address', '$country_id',
          '$city_id', '$state_id', '$status', Now())";

  if($conn->query($sql)){
    header("Location: ../tables.php?success=User added successfully!");
    exit;
  }
  else{
    echo "Error: " . $conn->Error;
  }
}
$roles = $conn->query("SELECT role_id, role_name FROM roles");
$countries = $conn->query("SELECT country_id, country_name FROM countries");
$cities = $conn->query("SELECT city_id, city_name FROM cities");
$states = $conn->query("SELECT state_id, state_name FROM states");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add User</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
<div class="container">
    <h2 class="mb-4">Add New User</h2>
    <form method="POST">

        <div class="form-group mb-3">
            <label>User Name</label>
            <input type="text" name="user_name" class="form-control" required>
        </div>

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
            <label>Phone No</label>
            <input type="text" name="phone_no" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="text" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Country</label>
            <select name="country_id" class="form-control" required>
                <option value="">-- Select Country --</option>
                <?php while ($co = $countries->fetch_assoc()): ?>
                    <option value="<?= $co['country_id'] ?>"><?= $co['country_name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label>City</label>
            <select name="city_id" class="form-control" required>
                <option value="">-- Select City --</option>
                <?php while ($ci = $cities->fetch_assoc()): ?>
                    <option value="<?= $ci['city_id'] ?>"><?= $ci['city_name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>State</label>
            <select name="state_id" class="form-control" required>
                <option value="">-- Select State --</option>
                <?php while ($st = $states->fetch_assoc()): ?>
                    <option value="<?= $st['state_id'] ?>"><?= $st['state_name'] ?></option>
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