<!DOCTYPE html>
<html>
<head>
    <title>IMD archive updater</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="out/css/style.css" />
</head>
<body>
<div class="container">
    <h1>Archive is going to be updated from IMDB</h1>
    <?php if (!empty($messages)) { foreach ( $messages as $message ) { ?><div class="message ok"><?php echo $message; ?></div><?php } } ?>
    <?php if (!empty($errors)) { foreach ( $errors as $error ) { ?><div class="message error"><?php echo $error; ?></div><?php } } ?>
    <footer>
        <p>&copy; 2012</p>
    </footer>
</div>
</body>
</html>