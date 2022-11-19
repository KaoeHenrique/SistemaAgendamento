<?php
include("../items/conexao.php");
require_once "../items/conexao.php";
$con = conectar();
$id = $_GET["id"];
$deletar = $con->prepare("DELETE FROM servico WHERE cod_serv='$id'");
$deletar2 = $con->prepare("DELETE FROM servico_funcionario WHERE FK_cod_serv='$id'");
$deletar2->execute();
$deletar->execute();
if($deletar):
    header('location: InclusionService.php');
endif;
?>