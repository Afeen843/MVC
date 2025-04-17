<?php \App\Bootstrap\View::render('layout/header', $data) ?>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-5">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="mt-3">Sign In</h2>
                        <p class="text-muted">Welcome back! Please sign in to your account</p>
                    </div>
                    <form method="POST" action="/login">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" name="email" class="form-control <?= $registerModel?->hasError('email') ? 'is-invalid' : '' ?>" id="email"
                                       value="<?= $registerModel?->email ?? '' ?>">
                                <?php if ($registerModel?->hasError('email')): ?>
                                    <div class="invalid-feedback">
                                        <?= $registerModel?->getErrorText('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control <?= $registerModel?->hasError('password') ? 'is-invalid' : '' ?>" id="password"
                                       value="<?= $registerModel?->password ?>">
                                <?php if ($registerModel?->hasError('password')): ?>
                                    <div class="invalid-feedback">
                                        <?= $registerModel?->getErrorText('password') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100 py-2">Sign In</button>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p>Don't have an account? <a href="/register" class="text-decoration-none">Create one</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php \App\Bootstrap\View::render('layout/footer'); ?>
