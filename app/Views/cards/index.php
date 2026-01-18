<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row mb-5">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1">My Cards</h2>
            <p class="text-secondary mb-0">Manage your payment methods and limits</p>
        </div>
        <button class="btn btn-primary-premium">
            <i class="fa-solid fa-plus me-2"></i>Add New Card
        </button>
    </div>
</div>

<div class="row">
    <!-- Card 1 -->
    <div class="col-md-4 mb-4">
        <div class="card-premium h-100">
            <div class="p-4 text-white"
                style="background: linear-gradient(135deg, #020024 0%, #090979 35%, #00d4ff 100%); border-radius: 12px 12px 0 0;">
                <div class="d-flex justify-content-between mb-4">
                    <i class="fa-brands fa-cc-visa fa-2x opacity-75"></i>
                    <span class="badge bg-white bg-opacity-25">Primary</span>
                </div>
                <h4 class="mb-1">**** **** **** 4242</h4>
                <div class="d-flex justify-content-between align-items-end mt-4">
                    <div>
                        <div class="small opacity-75">Card Holder</div>
                        <div class="fw-bold">Ali Ch</div>
                    </div>
                    <div>
                        <div class="small opacity-75">Expires</div>
                        <div class="fw-bold">12/28</div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <div class="d-flex justify-content-between small fw-bold text-secondary mb-2">
                        <span>Card Limit</span>
                        <span>$2,450 / $5,000</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: 45%"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-sm btn-outline-secondary">Freeze</button>
                    <button class="btn btn-sm btn-outline-secondary">Settings</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-4 mb-4">
        <div class="card-premium h-100">
            <div class="p-4 text-white"
                style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border-radius: 12px 12px 0 0;">
                <div class="d-flex justify-content-between mb-4">
                    <i class="fa-brands fa-cc-mastercard fa-2x opacity-75"></i>
                </div>
                <h4 class="mb-1">**** **** **** 8899</h4>
                <div class="d-flex justify-content-between align-items-end mt-4">
                    <div>
                        <div class="small opacity-75">Card Holder</div>
                        <div class="fw-bold">Ali Ch</div>
                    </div>
                    <div>
                        <div class="small opacity-75">Expires</div>
                        <div class="fw-bold">09/25</div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <div class="d-flex justify-content-between small fw-bold text-secondary mb-2">
                        <span>Card Limit</span>
                        <span>$120 / $1,000</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 12%"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-sm btn-outline-secondary">Freeze</button>
                    <button class="btn btn-sm btn-outline-secondary">Settings</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>