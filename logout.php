<?php
require_once 'configuracao.php';

session_unset();
session_destroy();

header("Location: login.php");
exit;
