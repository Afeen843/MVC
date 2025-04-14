<?php \App\Bootstrap\View::render('header',$data) ?>
<body class="bg-light">
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
                                <input type="text" name="firstName" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" name="lastName" class="form-control" id="lastName" required>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" required>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100 py-2">Register</button>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p>Already have an account? <a href="#" class="text-decoration-none">Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php \App\Bootstrap\View::render('footer'); ?>