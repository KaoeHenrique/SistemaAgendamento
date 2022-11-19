<?php
include("../items/conexao.php");
require_once "../items/conexao.php";
$con = conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_GET["id"])):
        $id = $_GET["id"];
    endif;

$listar = $con->prepare("SELECT * from servico WHERE cod_serv='$id'");
$listar->execute();
$lista = $listar->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST["editar"])):
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $duracao = $_POST["duracao"];
    $valor = $_POST["valor"];
    $alterar = $con->prepare("UPDATE servico SET nome_serv='$nome', desc_serv='$descricao', duracao_serv='$duracao', vlr_serv='$valor' WHERE cod_serv='$id'");
    $alterar->execute();

    if($alterar):
    header("Location: inclusionService.php");
endif;
endif;
    ?>
    <form method="POST">
        <input type="text" name="nome" placeholder="nome" value="<?php echo $lista["nome_serv"];?>">
        <input type="text" name="descricao" placeholder="descricao" value="<?php echo $lista["desc_serv"];?>">
        <input type="time" name="duracao" placeholder="Duração serviço" value="<?php echo $lista["duracao_serv"];?>">
        <input type="text" name="valor" placeholder="Valor Serviço" value="<?php echo $lista["vlr_serv"];?>">
        <input type="submit" name="editar" value="Editar">
    </form>

</body>
</html>