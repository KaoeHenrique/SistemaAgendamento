<?php 
require_once "../items/conexao.php";
$pdo2 = conectar();
$pdo3 = conectar();
            $sqlpr2 = "SELECT * FROM servico";
            $stmtpr2 = $pdo2->prepare($sqlpr2);
            $stmtpr2->execute();
            $jornada = $stmtpr2->fetchAll();
            ?>
<!DOCTYPE html>
<html lang="pt-br">

<?php 

require_once "../items/conexao.php";
$pdo4 = conectar();
$pdo5 = conectar();
$sql4 = "SELECT cod_serv FROM servico";
$stmt5 = $pdo4->prepare($sql4);
$stmt5->execute();
$p = $stmt5->fetch();
?>
<?php 

require_once "../items/conexao.php";
$pdo4 = conectar();
$sql5 = "SELECT id_serv_func FROM servico_funcionario";
$stmt6 = $pdo5->prepare($sql5);
$stmt6->execute();
$sf = $stmt6->fetch();
?>
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Cadastro de Serviços</title>
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
    <h1>Inclusão Serviço</h1>

    <form method="POST">
        <div class="form-group">
            <label>Nome Serviço</label>
            
            <input type="text" name="NomeServ" class="form-control col-6" placeholder="Descrição">
        </div>
        <div class="form-group">
            <label>Descrição do serviço</label>
            <input type="text" name="DescServ" class="form-control col-6" placeholder="Descrição">
        </div>
        <div class="form-group">
            <label>Tempo do serviço</label>
            <input type="time" name="DuracaoServ" class="form-control col-6" placeholder="Descrição">
        </div>
        <div class="form-group">
            <label>Valor Serviço</label>
            <input type="text" name="ValorServ" class="form-control col-6" placeholder="Descrição">
        </div>
        <br>
        <button type="submit" name="btnSalvar" class="btn btn-primary">Salvar</button>
        <button type="reset" name="btnLimpar" class="btn btn-warning">Limpar</button>
        <table class="table col-6">
        <thead>
            <tr>
                <th scope="col" class="col-3"></th>
                <th scope="col" class="col-3">Código </th>
                <th scope="col" class="col-3">Nome</th>
                <th scope="col" class="col-3">Descrição</th>
                <th scope="col" class="col-3">Valor</th>
                <th scope="col" class="col-2">Duração</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jornada as $p) { ?>
                <tr>
                    <td>
                    </td>
                    <td><?php echo $p['cod_serv']; ?> </td>
                    <td><?php echo $p['nome_serv']; ?></td>
                    <td><?php echo $p['desc_serv']; ?></td>
                    <td><?php echo $p['vlr_serv']; ?></td>
                    <td><?php echo $p['duracao_serv']; ?> 
                                                          <a href="editarServ.php?id=<?php echo $p['cod_serv'];?>"> Editar </a>
                                                          <a href="deletarServ.php?id=<?php echo $p['cod_serv'];?>"> deletar </a>
                   <!-- <button type="submit" name="btnDrop" class="btn btn-danger" value="<?php $p.$sf ?>">Deletar</button></td>!-->
                    
                </tr>
                
            <?php } ?>
            </table>
        </tbody>
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
require_once "../items/conexao.php";
$pdo = conectar();

if (isset($_POST['btnSalvar'])) {

    // buscar o conteudo do input descricao
    $NomeServ = isset($_POST['NomeServ']) ? $_POST['NomeServ'] : null;
    $DescServ = isset($_POST['DescServ']) ? $_POST['DescServ'] : null;
    $ValorServ = isset($_POST['ValorServ']) ? $_POST['ValorServ'] : null;
    $DuracaoServ = isset($_POST['DuracaoServ']) ? $_POST['DuracaoServ'] : null;

    // validando os dados vindos
    if (empty($NomeServ)) {
        echo "Necessário informar o nome do Serviço";
        exit();
    }
    if (empty($DescServ)) {
        echo "Necessário informar a descrição do serviço";
        exit();
    }
    if (empty($ValorServ)) {
        echo "Necessário informar o valor do serviço";
        exit();
    }
    if (empty($DuracaoServ)) {
        echo "Necessário informar a duração do serviço";
        exit();
    }

    $sql = "INSERT INTO servico (nome_serv, desc_serv, duracao_serv , vlr_serv) VALUES (:ns, :dds, :ds, :vs);";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ns', $NomeServ);
    $stmt->bindParam(':dds', $DescServ);
    $stmt->bindParam(':ds', $DuracaoServ);
    $stmt->bindParam(':vs', $ValorServ);

    if ($stmt->execute()) {
        echo "Registro inserido com sucesso";
    }
    
}

?>
<?php 
//     if (isset($_POST['btnDrop'])) {
//         $res2 = $pdo3->prepare("DELETE FROM servico_funcionario WHERE id_serv_func=". $sf["id_serv_func"]."");
//         $res2->execute();
//     $res = $pdo3->prepare("DELETE FROM servico WHERE cod_serv =" . $p['cod_serv']. "");
//     $res->execute();
// }
?>
<?php 
//     if (isset($_POST['btnMudar'])) {
//     $res = $pdo3->prepare("UPDATE `servico` SET `nome_serv`='[value-2]',`desc_serv`='[value-3]',`duracao_serv`='[value-5]',`vlr_serv`='[value-6]' WHERE 1 ");
//     $res->execute();
// }
?>