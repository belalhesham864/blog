<?php
session_start();
$user = $_SESSION['user'];
?>

<h1>Hello, <?= htmlspecialchars($user['name']) ?></h1>
<p>Email: <?= htmlspecialchars($user['email']) ?></p>
<p>Phone: <?= htmlspecialchars($user['phone']) ?></p>
<img src="../assets/images/<?= htmlspecialchars($user['image']) ?>" width="100">