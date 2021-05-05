<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Alle Aufträge</title>
</head>

<body>
    <h1>Alle Aufträge</h1>
    <table>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Telefonnummer</th>
            <th>Dringlichkeit</th>
            <th>Auftragsdatum</th>
            <th>Status</th>
            <th>deadline</th>
            <th>Werkzeug</th>
            <th></th>
        </tr>
        <form action="updatestatus" method="POST">
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td>
                        <input type="checkbox" value="<?= $order->id ?>" name="<?= $order->id ?>">
                    </td>
                    <td><?= e($order->name) ?></td>
                    <td><?= e($order->email) ?></td>
                    <td><?= e($order->phonenumber) ?? "" ?></td>
                    <td><?= $order->urgencyText ?></td>
                    <td><?= $order->orderdate ?? "" ?></td>
                    <td><?= $order->status == 1 ? "erledigt" : "offen" ?></td>
                    <td><?= $order->deadline ?? "" ?></td>
                    <td><?= $order->toolText ?? "" ?></td>
                    <td>
                        <a href="edit?id=<?= $order->id ?>">bearbeiten</a>
                    </td>
                </tr>
            <?php endforeach; ?>

    </table>
    <input type="submit" value="Status ändern von Ausgewählten Aufträge">
    </form>
    <a href="new">Auftrag erstellen</a>
    <a href="activeorders">Aktive Aufträge</a>

</body>

</html>