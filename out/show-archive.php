<!DOCTYPE html>
<html>
<head>
    <title>IMD TOP 10 archive movie list</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="out/css/style.css" />
</head>
<body>
<div class="container">
    <h1>IMDB Top 10</h1>
    <strong>Choose date by which to filter archive listing:</strong> <input type="text" id="datepicker" />

    <?php if (!empty($messages)) { foreach ( $messages as $message ) { ?><div class="message ok"><?php echo $message; ?></div><?php } } ?>
    <?php if (!empty($errors)) { foreach ( $errors as $error ) { ?><div class="message error"><?php echo $error; ?></div><?php } } ?>

    <div id="results">
        <?php if (!empty($data)): ?>
            <table class="table">
               <thead>
                <tr>
                    <th>Rank</th>
                    <th>Rating</th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Votes</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ( $data as $item ): ?>
                <tr>
                    <td><?php echo $item['rank']; ?></td>
                    <td><?php echo $item['rating']; ?></td>
                    <td><?php echo $item['title']; ?></td>
                    <td><?php echo $item['year']; ?></td>
                    <td><?php echo $item['votes']; ?></td>
                </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
             <div class="message notice">Sorry..No results there found for selected date.</div>
        <?php endif; ?>
    </div>
    <footer>
        <p>&copy; 2012</p>
    </footer>
</div>
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script src="out/js/gui.js" type="text/javascript"></script>
</body>
</html>