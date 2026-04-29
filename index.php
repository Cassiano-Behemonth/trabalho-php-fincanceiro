<?php
require_once 'configuracao.php';
require_once 'autenticacao.php';
require_once 'funcoes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $valor = floatval($_POST['valor'] ?? 0);
    $tipo = $_POST['tipo'] ?? '';

    if ($nome !== '' && $valor > 0 && in_array($tipo, ['Receita', 'Despesa'])) {
        $transacao = [
            'nome' => $nome,
            'valor' => $valor,
            'tipo' => $tipo,
            'data' => date('d/m/Y H:i')
        ];
        array_push($_SESSION['transacoes'], $transacao);
    }
}

include 'header.php';

$saldo = calcularSaldo($_SESSION['transacoes']);
$totalReceitas = 0;
$totalDespesas = 0;

foreach ($_SESSION['transacoes'] as $t) {
    if ($t['tipo'] === 'Receita') {
        $totalReceitas += $t['valor'];
    } else {
        $totalDespesas += $t['valor'];
    }
}
?>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold mb-1"><i class="bi bi-speedometer2"></i> Dashboard</h2>
        <p class="text-muted">Visão geral das suas finanças</p>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card h-100" style="border-left: 4px solid <?php echo $saldo >= 0 ? '#27ae60' : '#e74c3c'; ?>;">
            <div class="card-body text-center">
                <h6 class="text-muted text-uppercase fw-semibold mb-2">Saldo Total</h6>
                <h2 class="fw-bold mb-0" style="color: <?php echo $saldo >= 0 ? '#27ae60' : '#e74c3c'; ?>;">
                    <?php echo formatarMoeda($saldo); ?>
                </h2>
                <small class="text-muted"><?php echo count($_SESSION['transacoes']); ?> transação(ões)</small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100" style="border-left: 4px solid #27ae60;">
            <div class="card-body text-center">
                <h6 class="text-muted text-uppercase fw-semibold mb-2"><i class="bi bi-arrow-up-circle text-success"></i> Receitas</h6>
                <h2 class="fw-bold mb-0 text-success">
                    <?php echo formatarMoeda($totalReceitas); ?>
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100" style="border-left: 4px solid #e74c3c;">
            <div class="card-body text-center">
                <h6 class="text-muted text-uppercase fw-semibold mb-2"><i class="bi bi-arrow-down-circle text-danger"></i> Despesas</h6>
                <h2 class="fw-bold mb-0 text-danger">
                    <?php echo formatarMoeda($totalDespesas); ?>
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-plus-circle text-primary"></i> Nova Transação</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="index.php" id="form-transacao">
                    <div class="mb-3">
                        <label for="nome" class="form-label fw-semibold">Nome da Transação</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Salario, aluguel, mercado" required>
                    </div>
                    <div class="mb-3">
                        <label for="valor" class="form-label fw-semibold">Valor (R$)</label>
                        <input type="number" class="form-control" id="valor" name="valor" step="0.01" min="0.01" placeholder="0,00" required>
                    </div>
                    <div class="mb-4">
                        <label for="tipo" class="form-label fw-semibold">Tipo</label>
                        <select class="form-select" id="tipo" name="tipo" required>
                            <option value="" disabled selected>Selecione o tipo</option>
                            <option value="Receita">Receita</option>
                            <option value="Despesa">Despesa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold" id="btn-cadastrar">
                        <i class="bi bi-check-lg"></i> Cadastrar Transação
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
