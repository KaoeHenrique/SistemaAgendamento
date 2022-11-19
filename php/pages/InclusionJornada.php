<!-- mostrando todas as jornadas !-->
<?php 
require_once "../items/conexao.php";
$pdo2 = conectar();
$pdo3 = conectar();
            $sqlpr2 = "SELECT * FROM jornada";
            $stmtpr2 = $pdo2->prepare($sqlpr2);
            $stmtpr2->execute();
            $jornada = $stmtpr2->fetchAll();
            ?>
                <?php 

require_once "../items/conexao.php";
$pdo4 = conectar();
$pdo5 = conectar();
$sql6 = "SELECT FK_func_agenda FROM agenda";
$stmt7 = $pdo4->prepare($sql6);
$stmt7->execute();
$t = $stmt7->fetch();
?>
        <?php 

require_once "../items/conexao.php";
$pdo4 = conectar();
$pdo5 = conectar();
$sql4 = "SELECT id_func FROM funcionario";
$stmt5 = $pdo4->prepare($sql4);
$stmt5->execute();
$sf = $stmt5->fetch();
?>
            <?php 

require_once "../items/conexao.php";
$pdo4 = conectar();
$pdo5 = conectar();
$sql5 = "SELECT cod_jorn FROM jornada";
$stmt6 = $pdo5->prepare($sql5);
$stmt6->execute();
$p = $stmt6->fetch();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Cadastro de Horário</title>
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
    <h1>Inclusão Horário</h1>
    <form method="POST">
        <div class="form-group">
            <label>Entrada Jornada</label>
            <input type="time" name="entradaJ" class="form-control col-6" placeholder="Descrição">
        </div>
        <div class="form-group">
            <label>Saida Jornada</label>
            <input type="time" name="saidaJ" class="form-control col-6" placeholder="Descrição">
        </div>
        <div class="form-group">
            <label>Saida do Intervalo</label>
            <input type="time" name="saidaI" class="form-control col-6" placeholder="Descrição">
        </div>
        <div class="form-group">
            <label>Saida da jornada</label>
            <input type="time" name="saidaJ" class="form-control col-6" placeholder="Descrição">
            <table class="table col-6">
        <thead>
            <tr>
                <th scope="col" class="col-3"></th>
                <th scope="col" class="col-3">Código </th>
                <th scope="col" class="col-3">Entrada</th>
                <th scope="col" class="col-3">Intervalo</th>
                <th scope="col" class="col-3">Volta_Intervalo</th>
                <th scope="col" class="col-2">Fim do Expediente</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jornada as $p) { ?>
                <tr>
                    <td>
                    </td>
                    <td><?php echo $p['cod_jorn']; ?> </td>
                    <td><?php echo $p['ini_jorn']; ?></td>
                    <td><?php echo $p['ini_pausa_jorn']; ?></td>
                    <td><?php echo $p['fim_pausa_jorn']; ?></td>
                    <td><?php echo $p['fim_jorn']; ?>
                    <a href="editarhorario.php?id=<?php echo $p['cod_jorn'];?>"> editar </a>
                    <a href="deletarHorario.php?id=<?php echo $p['cod_jorn'];?>"> deletar </a>
                   <!-- <button type="submit" name="btnDrop" class="btn btn-danger" value="<//?php $p.$sf.$t?>">Deletar</button></td>!-->
                    
                </tr>
                
            <?php } ?>
        </tbody>
    </table>
        </div>
        <br>
        <button type="submit" name="btnSalvar" class="btn btn-primary">Salvar</button>
        <button type="reset" name="btnLimpar" class="btn btn-warning">Limpar</button>
        </div>
        </div>
        </div>
    </form>
 

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
<?php

$pdo = conectar();

if (isset($_POST['btnSalvar'])) {

    // buscar o conteudo do input descricao
    $entradaJ = isset($_POST['entradaJ']) ? $_POST['entradaJ'] : null;
    $saidaJ = isset($_POST['saidaJ']) ? $_POST['saidaJ'] : null;
    $saidaI = isset($_POST['saidaI']) ? $_POST['saidaI'] : null;
    $saidaJ = isset($_POST['saidaJ']) ? $_POST['saidaJ'] : null;

    // validando os dados vindos
    if (empty($entradaJ)) {
        echo "Necessário informar a Entrada do Funcionario";
        exit();
    }
    if (empty($saidaJ)) {
        echo "Necessário informar o Começo do Intervalo";
        exit();
    }
    if (empty($saidaI)) {
        echo "Necessário informar o Fim do intervalo";
        exit();
    }
    if (empty($saidaJ)) {
        echo "Necessário informar o Fim da jornada de trabalho";
        exit();
    }

    $sql = "INSERT INTO jornada (ini_jorn, ini_pausa_jorn, fim_pausa_jorn, fim_jorn) VALUES (:ej, :si, :ei, :sj);";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ej', $entradaJ);
    $stmt->bindParam(':si', $saidaJ);
    $stmt->bindParam(':ei', $saidaI);
    $stmt->bindParam(':sj', $saidaJ);

    if ($stmt->execute()) {
        echo "Registro inserido com sucesso";
    }
}

?>
<?php 
    if (isset($_POST['btnDrop'])) {
        $res3 = $pdo3->prepare("DELETE FROM agenda WHERE FK_func_agenda =" . $t['FK_func_agenda']. "");
    $res3->execute();
        $res2 = $pdo3->prepare("DELETE FROM funcionario WHERE id_func =" . $sf['id_func']. "");
    $res2->execute();
    $res = $pdo3->prepare("DELETE FROM jornada WHERE cod_jorn =" . $p['cod_jorn']. "");
    $res->execute();
}?>