<?php include_once 'core/config.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $status_code ?> | <?= $title ?></title>
    <?php include_once 'views/user/partial/link-user-style.php' ?>
</head>
<body class="bg-secondary-subtle">
    <div class="container text-center min-vh-100 border d-flex justify-content-center align-items-center flex-column">
        <h1 class="fw-bold mb-0" style="font-size: 80px;"><?= $status_code ?></h1>
        <p class="my-1 fw-semibold fs-4"><?= $title ?></p>
        <p><?= $message ?></p>
    </div>
</body>
</html>