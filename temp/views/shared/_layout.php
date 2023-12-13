<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $ViewData['title'] ?></title>
</head>

<body>
    <div>
        <?php
        include('./views/partials/header.php');
        ?>
    </div>
    <div>
        <?php
        include('./views/layouts/main.php');
        ?>
    </div>
    <div>
        <?php
        include('./views/partials/footer.php');
        ?>
    </div>
</body>

</html>