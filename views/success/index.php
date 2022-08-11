<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php require 'partials/header.php'; ?>

    <div id="main"> <!-- Main content -->
        <h1 class="center success"> <!--- Success message -->
            <?php echo $this->resultado_login; ?>
        <?php
            echo $this->message;
        ?>
        </h1>
    </div>

    <?php require 'partials/footer.php'; ?>
</body>
</html>