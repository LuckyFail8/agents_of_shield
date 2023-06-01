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
    <?php foreach ($countries as $country) : ?>
        <h2><?= $country->name ?></h2>
        <h3>Agents</h3>
        <?php foreach ($personByCountry[$country->name]['agents'] as $agent) : ?>
            <?= "$agent[name]" . " " . strtoupper($agent['last_name']) ?> <br>
        <?php endforeach ?>
        <h3>Contacts</h3>
        <?php foreach ($personByCountry[$country->name]['contacts'] as $contact) : ?>
            <?= "$contact[name]" . " " . strtoupper($contact['last_name']) ?> <br>
        <?php endforeach ?>
        <h3>Cibles</h3>
        <?php foreach ($personByCountry[$country->name]['targets'] as $target) : ?>
            <?= "$target[name]" . " " . strtoupper($target['last_name']) ?> <br>
        <?php endforeach ?>
    <?php endforeach ?>
</body>