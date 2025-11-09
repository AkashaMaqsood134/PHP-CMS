<?php
 include('../include/db.php');

 $id = $_GET['id'] ?? null;

  if(!$id){
    die ("City id is missing!");
  }
   
  $result = $conn ->query("SELECT *FROM cities WHERE city_id = $id");
  $countries = $conn ->query("SELECT country_id, country_name FROM countries");
  $city = $result ->fetch_assoc();

  if(isset($_POST['update'])){
    $city_name = $_POST['city_name'];
    $country_id = $_POST['country_id'];
    $status = $_POST['status'];

    $sql = "UPDATE cities SET city_name = '$city_name' , 
    country_id = '$country_id', status = '$status' WHERE city_id = $id";
     
     if($conn -> query($sql)){
        header("Location: ../tables.php?success=city updated successfully!");
        exit;
     }
     else{
        echo "Error: " . $conn ->Error;
     }

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit City</title>
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2 class="mb-4">Edit City</h2>
        <form method="POST">
            <div class="form-group">
                <label>City Name</label>
                <input type="text" name="city_name" class="form-control" value="<?php echo $city['city_name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Country</label>
                <select name="country_id" class="form-control">
                    <?php while ($c = $countries->fetch_assoc()): ?>
                        <option value="<?php echo $c['country_id']; ?>" <?php if ($c['country_id'] == $city['country_id']) echo 'selected'; ?>>
                            <?php echo $c['country_name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" <?php if ($city['status']) echo 'selected'; ?>>Active</option>
                    <option value="0" <?php if (!$city['status']) echo 'selected'; ?>>Inactive</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="../tables.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>