<?php
session_start();
include("config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['Id'])) {
    $id = $_GET['Id'];

    // Fetch the user record from the database
    $query = mysqli_query($con, "SELECT * FROM login WHERE Id = $id");
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        $res_Uname = $result['Username'];
        $res_Email = $result['Email'];
        $res_Age = $result['Age'];
        $res_id = $result['Id'];
    } else {
        echo "Profile not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Profile Details</title>
    <script>
        function confirmDelete() {
            return confirm("Apakah anda yakin ingin menghapus Akun?");
        }
    </script>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Profile</a> </p>
        </div>

        <div class="right-links">
            <a href="edit.php?Id=<?php echo $res_id; ?>" class="btn">Change Profile</a>
            <a href="delete.php?Id=<?php echo $res_id; ?>" class="btn" onclick="return confirmDelete()">Delete Profile</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Username: <b><?php echo $res_Uname ?></b></p>
                </div>
                <div class="box">
                    <p>Email: <b><?php echo $res_Email ?></b></p>
                </div>
                <div class="box">
                    <p>Age: <b><?php echo $res_Age ?></b></p>
                </div>
            </div>
            <div>
                <a href="home.php"><button class="btn">Back</button></a>
            </div>
        </div>
    </main>
</body>
</html>