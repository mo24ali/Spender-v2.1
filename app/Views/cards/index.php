<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row mb-5">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1">My Cards</h2>
            <p class="text-secondary mb-0">Manage your payment methods and limits</p>
        </div>
        <a href="/spender-v2/public/cards/create" class="btn btn-primary-premium">
            <i class="fa-solid fa-plus me-2"></i>Add New Card
        </a>
    </div>
</div>

<div class="row">
    <?php foreach ($cards as $index => $card):
        $gradients = [
            'linear-gradient(135deg, #020024 0%, #090979 35%, #00d4ff 100%)',
            'linear-gradient(135deg, #11998e 0%, #38ef7d 100%)',
            'linear-gradient(135deg, #f12711 0%, #f5af19 100%)'
        ];
        $gradient = $gradients[$index % count($gradients)];
        ?>
        <div class="col-md-4 mb-4">
            <div class="card-premium h-100">
                <div class="p-4 text-white" style="background: <?= $gradient ?>; border-radius: 12px 12px 0 0;">
                    <div class="d-flex justify-content-between mb-4">
                        <i class="fa-brands fa-cc-visa fa-2x opacity-75"></i>
                        <?php if ($index === 0): ?>
                            <span class="badge bg-white bg-opacity-25">Primary</span>
                        <?php endif; ?>
                    </div>
                    <h4 class="mb-1">**** **** **** <?= htmlspecialchars($card['num']) ?></h4>
                    <div class="d-flex justify-content-between align-items-end mt-4">
                        <div>
                            <div class="small opacity-75">Card Name</div>
                            <div class="fw-bold"><?= htmlspecialchars($card['nom']) ?></div>
                        </div>
                        <div>
                            <div class="small opacity-75">Expires</div>
                            <div class="fw-bold">
                                <?= htmlspecialchars($card['expiredate'] ? date('m/y', strtotime($card['expiredate'])) : '--/--') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between small fw-bold text-secondary mb-2">
                            <span>Balance / Limit</span>
                            <span>$<?= number_format($card['currentsold'], 2) ?> /
                                $<?= number_format($card['limite'], 2) ?></span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <?php
                            $percent = $card['limite'] > 0 ? ($card['currentsold'] / $card['limite']) * 100 : 0;
                            if ($percent > 100)
                                $percent = 100;
                            ?>
                            <div class="progress-bar bg-primary" style="width: <?= $percent ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/spender-v2/public/cards/edit?id=<?= $card['id'] ?>"
                            class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="/spender-v2/public/cards/delete?id=<?= $card['id'] ?>"
                            class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (empty($cards)): ?>
        <div class="col-md-12 text-center py-5 text-secondary">
            <i class="fa-solid fa-credit-card fs-2 mb-3 d-block opacity-25"></i>
            No cards found. <a href="/spender-v2/public/cards/create">Add one now.</a>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>