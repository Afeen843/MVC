<?php \App\Bootstrap\View::render('layout/header',$data) ?>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm mt-5">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="mt-3">Create Account</h2>
                        <p class="text-muted">Please fill in this form to create an account</p>
                    </div>
                    <form method="POST" action="/register">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" name="firstName" class="form-control <?= $registerModel?->hasError('firstName') ? 'is-invalid'  : ''?>" id="firstName"
                                       value="<?= $registerModel?->firstName ?? ''?>" >
                                <?php if($registerModel?->hasError('firstName')): ?>
                                <div class="invalid-feedback">
                                    <?= $registerModel?->getErrorText('firstName') ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" name="lastName" class="form-control <?= $registerModel?->hasError('lastName') ? 'is-invalid'  : ''?>" id="lastName"
                                       value="<?= $registerModel?->lastName ?? ''?>" >
                                <?php if($registerModel?->hasError('lastName')): ?>
                                    <div class="invalid-feedback">
                                        <?= $registerModel?->getErrorText('lastName') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" name="email" class="form-control <?=  $registerModel?->hasError('email') ? 'is-invalid'  : ''?>" id="email"
                                       value="<?= $registerModel?->email ?? ''?>" >
                                <?php if($registerModel?->hasError('email')): ?>
                                    <div class="invalid-feedback">
                                        <?= $registerModel?->getErrorText('email') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control <?= $registerModel?->hasError('password') ? 'is-invalid'  : ''?>" id="password"
                                           value="<?= $registerModel?->password?>">
                                <?php if($registerModel?->hasError('password')): ?>
                                    <div class="invalid-feedback">
                                        <?= $registerModel?->getErrorText('password') ?? 'FUCK' ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" name="confirmPassword" class="form-control <?= $registerModel?->hasError('confirmPassword') ? 'is-invalid'  : ''?>" id="confirmPassword"
                                           value="<?= $registerModel?->confirmPassword ?? ''?>">
                                <?php if($registerModel?->hasError('confirmPassword')): ?>
                                    <div class="invalid-feedback">
                                        <?= $registerModel?->getErrorText('confirmPassword') ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100 py-2">Register</button>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p>Already have an account? <a href="/login" class="text-decoration-none">Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php \App\Bootstrap\View::render('layout/footer'); ?>