<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Install Orange Framework</h1>
    <ul>

        <table class="table">
            <tr>
                <th>Create?</th>
                <th>Table name</th>
                <th>Entity name</th>
            </tr>
            <?php if (isset($entities) && !empty($entities)): ?>
                <?php foreach ($entities as $entity): ?>
                    <tr>
                        <td><input type="checkbox" name="create[]" checked value="<?php echo $entity ?>"></td>
                        <td><?php echo $entity ?></td>
                        <td>
                            <input type="text" class="form-control" id="<?php echo $entity ?>"
                                   value="<?php echo str_replace(' ', '',
                                       ucwords(preg_replace('/_|s$/', ' ', $entity))) ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <tr></tr>
        </table>
    </ul>
</div>

</body>
<footer>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
</footer>
</html>