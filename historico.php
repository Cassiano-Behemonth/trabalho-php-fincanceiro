<?php
include 'header.php';

if (isset($_GET['excluir'])) {
    $indice = intval($_GET['excluir']);
    if (isset($_SESSION['transacoes'][$indice])) {
        array_splice($_SESSION['transacoes'], $indice, 1);
    }
    header("Location: historico.php");
    exit;
}

$totalDespesas = calcularTotalDespesas($_SESSION['transacoes']);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Histórico de Movimentações</h4>
    <div class="d-flex gap-2">
        <a href="index.php" class="btn btn-outline-secondary" id="btn-voltar">
            &larr; Voltar
        </a>
        <a href="limpar_historico.php" class="btn btn-danger" id="btn-zerar"
           onclick="return confirm('Tem certeza que deseja zerar todas as transações?');">
            <i class="bi bi-trash3"></i> Zerar
        </a>
    </div>
</div>

<?php if (empty($_SESSION['transacoes'])): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
            <h5 class="text-muted mt-3">Nenhuma transação registrada</h5>
            <p class="text-muted">Cadastre sua primeira transação no <a href="index.php">Dashboard</a>.</p>
        </div>
    </div>
<?php else: ?>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="tabela-transacoes">
                <thead>
                    <tr class="text-muted" style="font-size: 0.85rem; border-bottom: 2px solid #dee2e6;">
                        <th class="fw-semibold py-3 ps-4">Data</th>
                        <th class="fw-semibold py-3">Descrição</th>
                        <th class="fw-semibold py-3">Categoria</th>
                        <th class="fw-semibold py-3 text-end">Valor</th>
                        <th class="fw-semibold py-3 text-center pe-4">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['transacoes'] as $index => $t): ?>
                        <tr>
                            <td class="ps-4 text-muted"><?php echo $t['data'] ?? '—'; ?></td>
                            <td class="fw-semibold"><?php echo htmlspecialchars($t['nome']); ?></td>
                            <td>
                                <?php if ($t['tipo'] === 'Receita'): ?>
                                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-1"><?php echo $t['tipo']; ?></span>
                                <?php else: ?>
                                    <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger px-3 py-1"><?php echo $t['tipo']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end fw-semibold">
                                <?php if ($t['tipo'] === 'Receita'): ?>
                                    <span class="text-success">+ <?php echo formatarMoeda($t['valor']); ?></span>
                                <?php else: ?>
                                    <span class="text-danger">- <?php echo formatarMoeda($t['valor']); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center pe-4">
                                <a href="historico.php?excluir=<?php echo $index; ?>" class="btn btn-sm btn-outline-danger rounded-circle" onclick="return confirm('Excluir esta transação?');" style="width: 30px; height: 30px; padding: 0; line-height: 30px;">
                                    <i class="bi bi-x-lg" style="font-size: 0.7rem;"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php include 'footer.php'; ?>
