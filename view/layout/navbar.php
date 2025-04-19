
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php if(!isset($_SESSION['user_id'])): ?>
                <a href="/login" class="btn btn-outline-light me-2">Sign In</a>
                <a href="/register" class="btn btn-primary">Register</a>
                <?php else: ?>
                    <a href="/logout" class="btn btn-outline-light me-2">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>