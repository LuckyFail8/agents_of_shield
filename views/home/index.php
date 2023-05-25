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
    <p>
        In ea culpa dolor in anim officia nisi dolor ex deserunt anim magna dolore. Aliqua cupidatat velit ullamco cillum anim et sunt nulla qui commodo. Incididunt ex dolore sit mollit et occaecat ipsum mollit anim sit aute nostrud non. Aute enim dolor sit pariatur ipsum irure occaecat reprehenderit reprehenderit enim deserunt magna nostrud adipisicing.

        Deserunt dolor mollit dolor non nulla laborum sit consequat enim. Non commodo irure laborum exercitation aliqua tempor amet enim. Dolor adipisicing nostrud occaecat sit officia laboris consequat. Sit aliqua amet commodo velit et culpa. Tempor incididunt occaecat proident aliqua eiusmod. Esse cupidatat dolore laborum voluptate veniam exercitation proident velit do pariatur culpa pariatur anim.
    </p>
    <section>
        <h2>Agents</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pays</th>
                    <th>Code d'identification</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($agents as $agent) : ?>
                    <tr>
                        <td><?= $agent->agent_id ?></td>
                        <td><?= $agent->last_name ?></td>
                        <td><?= $agent->name ?></td>
                        <td><?= $agent->country_name ?></td>
                        <td><?= $agent->identification_code ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Contacts</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pays</th>
                    <th>Nom de code</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact) : ?>
                    <tr>
                        <td><?= $contact->contact_id ?></td>
                        <td><?= $contact->last_name ?></td>
                        <td><?= $contact->name ?></td>
                        <td><?= $contact->country_name ?></td>
                        <td><?= $contact->code_name ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
    <section>
        <h2>Cibles</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pays</th>
                    <th>Nom de code</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($targets as $target) : ?>
                    <tr>
                        <td><?= $target->target_id ?></td>
                        <td><?= $target->last_name ?></td>
                        <td><?= $target->name ?></td>
                        <td><?= $target->country_name ?></td>
                        <td><?= $target->code_name ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</body>

</html>