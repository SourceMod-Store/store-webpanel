<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Redeem Result Page">
        <meta name="author" content="Werner 'Arrow768'">

        <title>Grid Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url("assets/css/grid.css"); ?>" rel="stylesheet">
    </head>

    <body>
        <div class="container">

            <div class="page-header">
                <h1>Redeem Result Page</h1>
                <p class="lead">Thank you for using the redeem system. The results can be found below.</p>
            </div>

            <?php if ($status == "success"): ?>
                <div class="alert alert-success">You have successfully redeemed the code</div>
                <?php if ($items != 0): ?>
                    <h3>Items</h3>
                    <?php foreach ($items as $item): ?>
                        <div class="alert alert-info"><?php echo $item; ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if ($credits != 0): ?>
                    <h3>Credits</h3>
                    <div class="alert alert-info">You have received <?php echo $credits; ?> Credits</div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-danger">You could not redeem the code</div>
                <h3>Errors</h3>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-warning"><?php echo $error; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div> <!-- /container -->
    </body>
</html>
