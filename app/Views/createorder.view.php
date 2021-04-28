<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Auftrag erstellen</title>
</head>

<body>
    <h1>Auftrag erstellen</h1>
    <?php if (!empty($errors)) : ?>    
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form action="/Reparaturwerkstatt/create" method="POST">
        <fieldset>
            <legend>Kontaktperson</legend>

            <label for="name">Name</label>
            <input type="text" , id="name" , name="name" require>

            <label for="email">E-Mail</label>
            <input type="email" , id="email" , name="email" require>

            <label for="telefon">Telefon</label>
            <input type="text" , id="telefon">

        </fieldset>
        <fieldset>
            <legend>Auftragsinformationen</legend>

            <label for="urgency" require>Dringlichkeit</label>
            <select name="urgency" id="urgency">
                <option value="1">sehr tief</option>
                <option value="2">tief</option>
                <option selected value="3">normal</option>
                <option value="4">hoch</option>
                <option value="5">sehr hoch</option>
            </select>

            <label for="tool" require>Werkzeug</label>
            <select name="tool" id="tool">
                <?php foreach ($tools as $tool) : ?>
                    <option value="<?= $tool['id'] ?>"><?= $tool['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>
        <input type="submit" value="Auftrag erstellen">
    </form>
</body>

</html>