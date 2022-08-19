<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('../config.php'); ?>
    <?php include '../db/dbConnect.php'; ?>
    <link href="<?php echo $css_path; ?>" rel="stylesheet">
    <!-- get Title from config.php -->

    <title><?php echo $site_name; ?></title>
</head>
<body>
    <?php include('../components/reg-form.php'); ?>
</body>
    <?php include('../components/footer.php'); ?>
</html>