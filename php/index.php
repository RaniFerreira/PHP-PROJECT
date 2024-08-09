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
        include './usuario.php';

        $u = new Usuario();
        print_r($u->recebeUsuario('a@a.com'));
       
    ?>
</body>
</html>