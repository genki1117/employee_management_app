<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require __DIR__ . '/_head.php'; ?>
    <title>管理者ログイン</title>
</head>

<body>
    <main>
        <section class="h-100">
            <div class="container h-100">
                <div class="row justify-content-sm-center h-100">
                    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                        <div class="text-center my-5">
                            <?php require __DIR__ . '/../_message_view.php'; ?>
                        </div>
                        <div class="card shadow-lg">
                            <div class="card-body p-5">
                                <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                                <form method="POST" action="login_post.php" class="needs-validation" novalidate="" autocomplete="off">
                                    <input type="hidden" name="csrf_token" value="<?= h($csrf_token); ?>">
                                    <div class="mb-3">
                                        <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                        <input id="email" type="email" class="form-control" name="email" value="" autofocus>
                                        <div class="invalid-feedback">
                                            Email is invalid
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 w-100">
                                            <label class="text-muted" for="password">Password</label>
                                            <!-- forget password -->
                                            <!-- <a href="forgot.html" class="float-end">
                                            Forgot Password?
                                        </a> -->
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password">
                                        <div class="invalid-feedback">
                                            Password is required
                                        </div>
                                    </div>
                                    <!-- remnber me check box -->
                                    <div class="d-flex align-items-center">
                                        <!-- <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div> -->
                                        <button type="submit" class="btn btn-primary ms-auto">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- <div class="card-footer py-3 border-0">
                                <div class="text-center">
                                    Don't have an account? <a href="register.html" class="text-dark">Create One</a>
                                </div>
                            </div> -->
                        </div>
                        <!-- <div class="text-center mt-5 text-muted">
                        Copyright &copy; 2017-2021 &mdash; Your Company
                    </div> -->
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="js/login.js"></script>
</body>

</html>