<?php
include("../items/conexao.php");
require_once "../items/conexao.php";
$con = conectar();
$id = $_GET["id"];
$deletar = $con->prepare("DELETE FROM agenda WHERE FK_func_agenda='$id'");
$deletar2 = $con->prepare("DELETE FROM funcionario WHERE id_func='$id'");
$deletar3 = $con->prepare("DELETE FROM jornada WHERE cod_jorn='$id'");
$deletar->execute();
$deletar2->execute();
$deletar3->execute();
if($deletar):
    header('location: InclusionJornada.php');
endif;
?>