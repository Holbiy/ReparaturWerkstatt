<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle Aufträge</title>
</head>

<body>
    <h1>Alle Aufträge</h1>
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

        <?php foreach ($orders as $order) : ?>
            <tr>
                <td><?= $order->name ?></td>
                <td><?= $order->email ?></td>
                <td><?= $order->phonenumber ?? "" ?></td>
                <td><?php
                    if (isset($order->urgancy)) {
                        switch ($order->urgancy) {
                            case 1:
                                echo "sehr tief";
                                break;
                            case 2:
                                echo "tief";
                                break;
                            case 3:
                                echo "normal";
                                break;
                            case 4:
                                echo "hoch";
                                break;
                            case 5:
                                echo "sehr hoch";
                                break;
                        }
                    }

                    ?></td>
                <td><?= $order->orderdate ?? "" ?></td>
                <td><?= $order->status == 1 ? "erledigt" : "" ?></td>
                <td><?= $order->deadline ?? "" ?></td>
                <td><?= $order->tool ?? "" ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>