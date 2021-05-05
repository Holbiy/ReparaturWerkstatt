<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/form.css">
    <title>Auftrag bearbeiten</title>
</head>

<body>
    <h1>Auftrag bearbeiten</h1>

    <div class="form">

        <ul id="errorList">
            <?php if (!empty($errors)) : ?>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <form action="update" method="POST">

            <fieldset>
                <input type="hidden" value="<?= $order->id ?? "" ?>" name="id" require>
                <legend>Kontaktperson</legend>

                <label for="name" require>Name</label>
                <input type="text" id="name" name="name" value="<?= $order->name ?? "" ?>" require>

                <label for="email" require>E-Mail</label>
                <input type="email" id="email" name="email" value="<?= $order->email ?? "" ?>">

                <label for="phonenumber">Telefon</label>
                <input type="text" id="phonenumber" name="phonenumber" value="<?= $order->phonenumber ?? "" ?>">

            </fieldset>

            <fieldset>
                <legend>Auftragsinformationen</legend>

                <label for="status">Abgeschlossen</label>
                <input <?= ($order->status ?? "") == 1 ? "checked" : "" ?> type="checkbox" name="status" id="status" value="1"><br><br>

                <label for="tool" require>Werkzeug</label>
                <select name="tool" id="tool" require>
                    <?php foreach ($tools as $tool) : ?>
                        <option <?= $tool['id'] == ($order->toolid ?? "") ? "selected" : "" ?> value="<?= $tool['id'] ?>"><?= $tool['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="urgancy">Dringlichkeit</label>
                <input type="text" id="urgency" name="urgency" disabled value="<?= $order->urgencyText ?? "" ?>">

                <label for="orderdate">Auftragsdatum</label>
                <input type="text" id="orderdate" name="orderdate" disabled value="<?= $order->orderdate ?? "" ?>">

                <label for="deadline">Deadline</label>
                <input type="text" id="deadline" name="deadline" disabled value="<?= $order->deadline ?? "" ?>">


            </fieldset>

            <input class="orange" type="submit" value="Auftrag ändern">
        </form>

        <a class="orange" href="allorders">Abbrechen</a>

    </div>
    <script src="public/js/validation.js"></script>
</body>

</html>