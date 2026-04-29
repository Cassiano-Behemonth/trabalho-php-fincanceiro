<?php
require_once 'configuracao.php';
require_once 'autenticacao.php';
$_SESSION['transacoes'] = [];
header("Location: historico.php");
exit;
