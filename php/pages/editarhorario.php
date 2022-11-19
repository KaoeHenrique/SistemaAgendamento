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

$listar = $con->prepare("SELECT * from jornada WHERE cod_jorn='$id'");
$listar->execute();
$lista = $listar->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST["editar"])):
    $inijorn = $_POST["ini_jorn"];
    $inipausajorn = $_POST["ini_pausa_jorn"];
    $fimpausajorn = $_POST["fim_pausa_jorn"];
    $fimjorn = $_POST["fim_jorn"];
    $alterar = $con->prepare("UPDATE jornada SET ini_jorn='$inijorn', ini_pausa_jorn='$inipausajorn', fim_pausa_jorn='$fimpausajorn', fim_jorn='$fimjorn' WHERE cod_jorn='$id'");
    $alterar->execute();

    if($alterar):
    header("Location: inclusionJornada.php");
endif;
endif;
    ?>
    <form method="POST">
    <div class="form-group">
        <input type="time" name="ini_jorn" placeholder="Inicio" class="form-control col-6" value="<?php echo $lista["ini_jorn"];?>">
</div>
<div class="form-group">
        <input type="time" name="ini_pausa_jorn" placeholder="Pausa" class="form-control col-6" value="<?php echo $lista["ini_pausa_jorn"];?>">
</div>
<div class="form-group">
        <input type="time" name="fim_pausa_jorn" placeholder="Fim Pausa" class="form-control col-6" value="<?php echo $lista["fim_pausa_jorn"];?>">
</div>
<div class="form-group">
        <input type="time" name="fim_jorn" placeholder="Fim Jornada" class="form-control col-6" value="<?php echo $lista["fim_jorn"];?>">
</div>
<div class="form-group">
        <input type="submit" name="editar" value="Editar">
</div>
    </form>
</div>
</body>
</html>