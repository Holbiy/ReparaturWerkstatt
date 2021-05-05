<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/form.css">
    <title>Auftrag erstellen</title>
</head>

<body>
    <h1>Auftrag erstellen</h1>

    <div class="form">

        <ul id="errorList">
            <?php if (!empty($errors)) : ?>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <form action="create" method="POST">

            <fieldset>
                <legend>Kontaktperson</legend>

                <label for="name">Name</label>
                <input value="<?= $name ?? "" ?>" type="text" , id="name" , name="name" require>

                <label for="email">E-Mail</label>
                <input value="<?= $email ?? "" ?>" type="email" , id="email" , name="email" require>

                <label for="phonenumber">Telefon</label>
                <input value="<?= $phonenumber ?? "" ?>" type="text" name="phonenumber" id="phonenumber">

            </fieldset>

            <fieldset>
                <legend>Auftragsinformationen</legend>

                <label for="urgency" require>Dringlichkeit</label>
                <select name="urgency" id="urgency">
                    <option <?= $urgency ?? "" == 3 ? "selected" : "" ?> value="3">normal</option>
                    <option <?= $urgency ?? "" == 1 ? "selected" : "" ?> value="1">sehr tief</option>
                    <option <?= $urgency ?? "" == 2 ? "selected" : "" ?> value="2">tief</option>
                    <option <?= $urgency ?? "" == 4 ? "selected" : "" ?> value="4">hoch</option>
                    <option <?= $urgency ?? "" == 5 ? "selected" : "" ?> value="5">sehr hoch</option>
                </select>
                <p id="deadlineMessage">Test</p>

                <label for="tool" require>Werkzeug</label>
                <select name="tool" id="tool" require>
                    <?php foreach ($tools as $tool) : ?>
                        <option value="<?= $tool['id'] ?>"><?= $tool['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </fieldset>

            <input type="submit" value="Auftrag erstellen">

        </form>

        <a class="orange" href="allorders">Abbrechen</a>

    </div>
    <script src="public/js/deadline.js"></script>
    <script src="public/js/validation.js"></script>
</body>

</html>