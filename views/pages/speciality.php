<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        td {
            border: 1px solid;
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php foreach ($specialities as $speciality) : ?>
        <h2><?= $speciality->name ?></h2>
        <?php foreach ($agentsBySpeciality[$speciality->name]['agents'] as $agent) : ?>
            <?= "$agent[name]" . " " . strtoupper($agent['last_name']) ?> <br>
        <?php endforeach ?>

    <?php endforeach ?>
</body>