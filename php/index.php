<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
        include './conexao.php';
        include './lista.php';

        $g = new Lista();
        print_r($g->getItensUsuario('a@a.com'));
       
    ?>
</body>
</html>