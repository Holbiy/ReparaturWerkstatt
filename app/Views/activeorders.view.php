<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Alle aktiven Aufträge</title>
</head>

<body>
    <h1>Alle aktiven Aufträge</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Telefonnummer</th>
            <th>Dringlichkeit</th>
            <th>Auftragsdatum</th>
            <th>Status</th>
            <th>deadline</th>
            <th>Werkzeug</th>
            <th>Im Zeitlimit</th>
        </tr>

        <?php foreach ($activeorders as $order) : ?>
            <tr>
                <td><?= e($order->name) ?></td>
                <td><?= e($order->email) ?></td>
                <td><?= e($order->phonenumber) ?? "" ?></td>
                <td><?= $order->urgencyText ?></td>
                <td><?= $order->orderdate ?></td>
                <td><?= $order->status == 1 ? "erledigt" : "offen" ?></td>
                <td><?= $order->deadline ?></td>
                <td><?= $order->toolText ?></td>
                <td><?= $order->deadline >= date('Y-m-d') ?  '&#128077;' : '&#128078;' ?></td>
            </tr>
        <?php endforeach; ?>

    </table>

    <a href="allorders">Alle Aufträge</a>
</body>

</html>