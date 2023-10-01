<?php

require_once 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data from the form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    $sql = "INSERT INTO applications (first_name, last_name, phone, country, city, email, position) 
            VALUES (:firstName, :lastName, :phone, :country, :city, :email, :position)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':position', $position);

    try {
        $stmt->execute();

        header('Location: success.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
