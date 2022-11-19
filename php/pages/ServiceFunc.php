<?php
require_once "../items/conexao.php";

$pdo = conectar();
$pdo2 = conectar();
// criando um select para pegar todas as 
// categorias que tem na tabela.


// preparando o sql para não aceitar sql injection
$stmtcat = $pdo->prepare("SELECT servico.cod_serv, servico.nome_serv FROM servico");
$stmtcat->execute();

// pegando todos os dados da tabela
$servico = $stmtcat->fetchAll();
$stmtcat2 = $pdo2->prepare("SELECT funcionario.id_func, funcionario.nome_func FROM funcionario");
$stmtcat2->execute();

// pegando todos os dados da tabela
$funcionario = $stmtcat2->fetchAll();
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<div class="bordasuprema">
    <div class="borderright">
        <div class="elemento1">
        <a class="a1" href="inclusionService.php"> Adicionar Serviço <a><br></div>
        <div class="elemento2">
        <a class="a1" href="inclusionAdmin.php"> Adicionar Funcionário <a><br></div>
        <div class="elemento3">
        <a class="a1" href="inclusionJornada.php"> Adicionar Horário <a><br></div>
        <div class="elemento4">
        <a class="a1" href="ServiceFunc.php"> Adicionar na agenda <a><br></div>
        <div class="elemento5">
        <a class="a1" href="admin.php"> Voltar área Admin <a><br></div>

</div>
<div class="total">
<div class="form-group">
<form method="POST" enctype="multipart/form-data">
            <label>Serviço</label>
            <!-- Aqui entra o codigo da chave estrangeira -->
            <select name="jornada_cod" class="form-control col-6">
                <option>-- Escolha --</option>
                <!-- Sempre dentro do select vai o codigo php
                     que carrega os dados da tabela 
                -->
                <?php
                foreach ($servico as $s) {
                ?>
                    <option value="<?php echo $s['cod_serv']; ?>"><?php echo $s['nome_serv']; ?></option>
                <?php } ?>
            </select>
        <br>
        <div class="form-group">
            <label>Funcionario</label>
            <!-- Aqui entra o codigo da chave estrangeira -->
            <select name="cod_jornnn" class="form-control col-6">
                <option>-- Escolha --</option>
                <!-- Sempre dentro do select vai o codigo php
                     que carrega os dados da tabela 
                -->
                <?php
                foreach ($funcionario as $f) {
                ?>
                    <option value="<?php echo $f['id_func']; ?>"><?php echo $f['nome_func']; ?></option>
                <?php } ?>
            </select><br>
            <button type="submit" name="btnSalvar" class="btn btn-primary">Enviar</button>
        <br>
                </form>
</body>
                </div>
<?php
if(isset($_POST['btnSalvar'])) {
    $jornada_cod  = isset($_POST['jornada_cod']) ? $_POST['jornada_cod'] : null;
    $cod_jornnn  = isset($_POST['cod_jornnn']) ? $_POST['cod_jornnn'] : null; 

    $sql = "INSERT INTO servico_funcionario (FK_cod_serv, FK_id_func) VALUES (:jornada_cod, :cod_jornnn)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':jornada_cod', $jornada_cod);
    $stmt->bindParam(':cod_jornnn', $cod_jornnn);
    if ($stmt->execute()) {
        echo "Registro inserido com sucesso";
    }
}
?>
</html>