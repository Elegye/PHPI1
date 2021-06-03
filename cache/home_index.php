<?php class_exists('App\Core\Template\Template') or exit; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table de 13</title>
    <style>
    table,
    td {
        border: 1px solid #333;
        margin: 2px;
    }
    thead,
    tfoot {
        background-color: #333;
        color: #fff;
    }
    </style>
</head>
<body>
    <?php echo hello ?>
    <form method="post">
    <div>
        <label for="say">Quelle salutation voulez-vous adresser ?</label>
        <input name="say" id="say" value="Salut">
    </div>
    <div>
        <label for="to">À qui voulez‑vous l'adresser ?</label>
        <input name="to" value="Maman">
    </div>
    <div>
        <button>Envoyer mes salutations</button>
    </div>
    </form>
    <table>
        <thead>
        <tr>
            <th>
            </th>
            <th>
            *
            </th>
            <th>
            =
            </th>
        </tr>
        </thead>
        <tbody>
            
            <?php
            for($i = 0; $i <= 10; $i++){
            ?>
            <tr>
                <td>13</td>
                <td><?= $i; ?></td>
                <td><?= $i * 13; ?></td>
            </tr>
            <?php
            }
            ?>
            
        </tbody>
    </table>
    
</body>
</html>