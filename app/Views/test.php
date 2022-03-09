<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hello</title>
    <style>
        input {
            display: block;
            margin: 10px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <table border="1">
        <tr>
            <th>sr</th>
            <th>name</th>
            <th>email</th>
            <th>mobile</th>
        </tr>
        <?php
        $count = $data['record_start_index'];
        foreach ($data['data'] as $k => $v) : ?>
            <tr>
                <td><?= ++$count ?></td>
                <td><?= $v['name'] ?></td>
                <td><?= $v['email'] ?></td>
                <td><?= $v['mobile'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?= $pagination ?>
</body>

</html>