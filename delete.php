<?php
session_start();
include("config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['Id'])) {
    $id = $_GET['Id'];

    // Delete the user record from the database
    $query = "DELETE FROM login WHERE Id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
        // If the record is successfully deleted, log the user out and redirect to the homepage
        session_destroy();
        header("Location: index.php");
    } else {
        echo "Failed to delete the profile. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>