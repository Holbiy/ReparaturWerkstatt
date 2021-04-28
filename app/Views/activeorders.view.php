<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        </tr>
        <tr>
            <?php foreach($orders as $order):?>
                <td><?=$order->name?></td>
                <td><?=$order->email?></td>
                <td><?=$order->phonenumber?></td>
                <td><?=$order->urgancy?></td>
                <td><?=$order->orderdate?></td>
                <td><?=$order->status?></td>
                <td><?=$order->deadline?></td>
                <td><?=$order->tool?></td>
            <?endforeach;?>
        </tr>
    </table>
</body>
</html>