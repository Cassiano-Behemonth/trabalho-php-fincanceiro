<?php

function calcularSaldo($transacoes)
{
    $saldo = 0.0;
    foreach ($transacoes as $t) {
        if ($t['tipo'] === 'Receita') {
            $saldo += $t['valor'];
        } elseif ($t['tipo'] === 'Despesa') {
            $saldo -= $t['valor'];
        }
    }
    return $saldo;
}

function formatarMoeda($valor)
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

function calcularTotalDespesas($transacoes)
{
    $total = 0.0;
    foreach ($transacoes as $t) {
        if ($t['tipo'] === 'Despesa') {
            $total += $t['valor'];
        }
    }
    return $total;
}

function calcularRelevancia($valorDespesa, $totalDespesas)
{
    if ($totalDespesas <= 0) {
        return 0.0;
    }
    return ($valorDespesa / $totalDespesas) * 100;
}
