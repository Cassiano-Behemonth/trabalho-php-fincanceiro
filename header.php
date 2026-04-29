<?php
require_once 'configuracao.php';
require_once 'autenticacao.php';
require_once 'funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Controle Financeiro Pessoal - Gerencie suas receitas e despesas de forma simples e eficiente.">
    <title>Meu Controle Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --cor-primaria: #2c3e50;
            --cor-sucesso: #27ae60;
            --cor-perigo: #e74c3c;
            --cor-info: #2980b9;
            --cor-fundo: #f0f2f5;
        }

        body {
            background-color: var(--cor-fundo);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: linear-gradient(135deg, var(--cor-primaria) 0%, #1a252f 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }

        .navbar-brand i {
            color: var(--cor-sucesso);
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin: 0 2px;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            transform: translateY(-1px);
        }

        .nav-link.active {
            background-color: rgba(255,255,255,0.15);
        }

        .btn-sair {
            background-color: var(--cor-perigo);
            color: #fff !important;
            border: none;
            padding: 0.4rem 1rem !important;
            border-radius: 20px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-sair:hover {
            background-color: #c0392b;
            box-shadow: 0 2px 8px rgba(231,76,60,0.4);
        }

        .content-wrapper {
            flex: 1;
            padding: 2rem 0;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-wallet2"></i> Meu Controle Financeiro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" id="nav-dashboard">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="historico.php" id="nav-historico">
                            <i class="bi bi-clock-history"></i> Histórico
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="nav-link btn-sair" href="logout.php" id="nav-sair">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="container">
