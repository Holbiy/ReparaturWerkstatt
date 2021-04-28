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
    <form action="" method="POST">
        <fieldset>
            <legend>Kontaktperson</legend>

            <label for="name">Name</label>
            <input type="text" , id="name" , name="name">

            <label for="email">E-Mail</label>
            <input type="email" , id="email" , name="email">

            <label for="telefon">Telefon</label>
            <input type="text" , id="telefon">

        </fieldset>
        <fieldset>
            <legend>Auftragsinformationen</legend>

            <label for="urgency">Dringlichkeit</label>
            <select name="urgency" id="urgency">
                <option value="1">sehr tief</option>
                <option value="2">tief</option>
                <option selected value="3">normal</option>
                <option value="4">hoch</option>
                <option value="5">sehr hoch</option>
            </select>

            <label for="tool">Werkzeug</label>
            <select name="tool" id="tool">
                <option value="1">Hammer</option>
                <option value="2">Schraubenzieher</option>
                <option selected value="3">Motorsäge</option>
                <option value="4">hoch</option>
                <option value="5">sehr hoch</option>
            </select>
        </fieldset>
        <input type="submit" value="Auftrag erstellen">
    </form>
</body>

</html>