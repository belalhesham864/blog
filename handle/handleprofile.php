<?php
session_start();
require '../db/conecation.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $select = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $res = mysqli_query($conc, $select);

    if ($res && mysqli_num_rows($res) === 1) {
        $user = mysqli_fetch_assoc($res);

        $_SESSION['user'] = [
            'phone' => $user['phone'],
            'name' => $user['name'],
            'email' => $user['email'],
            'image' => $user['image'],
        ];
        header("Location: ../profile.php");
exit();
    }}