<?php
include("../items/conexao.php");
require_once "../items/conexao.php";
$con = conectar();
?>
<?php 
require_once "../items/conexao.php";

$pdo = conectar();
$sqlcat = "SELECT * FROM jornada";
// preparando o sql para não aceitar sql injection
$stmtcat = $pdo->prepare($sqlcat);
$stmtcat->execute();

// pegando todos os dados da tabela
$funcionario = $stmtcat->fetchAll();
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

$listar = $con->prepare("SELECT * from funcionario WHERE id_func='$id'");
$listar->execute();
$lista = $listar->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST["editar"])):
    $nome = $_POST["nome"];
    $telefone = $_POST["tel"];
    $endereco = $_POST["endereco"];
    $dataNasc = $_POST["datanasc"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $cod_jornada = $_POST["jornada_cod"];
    $alterar = $con->prepare("UPDATE funcionario SET nome_func='$nome', tel_func='$telefone', endereco_func='$endereco', dt_nasc_func='$dataNasc', senha_func='$senha', email_func='$email', FK_cod_jorn='$cod_jornada' WHERE id_func='$id'");
    $alterar->execute();

    if($alterar):
    header("Location: inclusionAdmin.php");
endif;
endif;
    ?>
    <form method="POST">
    <div class="form-group">
        <input type="text" name="nome" placeholder="nome" class="form-control col-6" value="<?php echo $lista["nome_func"];?>">
</div>
<div class="form-group">
        <input type="text" name="tel" placeholder="telefone" class="form-control col-6" value="<?php echo $lista["tel_func"];?>">
</div>
<div class="form-group">
        <input type="text" name="endereco" placeholder="Endereço Funcionário" class="form-control col-6" value="<?php echo $lista["endereco_func"];?>">
</div>
<div class="form-group">
        <input type="date" name="datanasc" placeholder="Data de Nascimento" class="form-control col-6" value="<?php echo $lista["dt_nasc_func"];?>">
</div>
<div class="form-group">
        <input type="password" name="senha" placeholder="Senha Funcionário" class="form-control col-6" value="<?php echo $lista["senha_func"];?>">
</div>
<div class="form-group">
        <input type="email" name="email" placeholder="Email Funcionário" class="form-control col-6" value="<?php echo $lista["email_func"];?>">
</div>
<div class="form-group">
<select name="jornada_cod" class="form-control col-6">
                <option>-- Escolha --</option>
                <!-- Sempre dentro do select vai o codigo php
                     que carrega os dados da tabela 
                -->
                <?php
                foreach ($funcionario as $f) {
                ?>
                    <option value="<?php echo $f['cod_jorn']; ?>"><?php echo $f['ini_jorn']; ?></option>
                <?php } ?>
            </select>
        <input type="submit" name="editar" value="Editar">
</div>
    </form>
</div>
</body>
</html>