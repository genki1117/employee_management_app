<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">管理者管理画面</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="ナビゲーションの切替">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="Navber">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">ホーム</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">管理者登録</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">ユーザー一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ユーザー登録</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">社員一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">社員登録</a>
                </li> -->
            </ul>
            <form action="../../app/admin/search_post.php" method="post" class="d-flex">
                <input type="text" name="word" class="form-control me-2" placeholder="名前検索" aria-label="名前検索">
                <button type="submit" class="btn btn-outline-success flex-shrink-0">検索</button>
            </form>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php $account_name = get_account_name(); ?>
                    <?= h($account_name); ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">メニュー1</a></li>
                    <li><a class="dropdown-item" href="#">メニュー2</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="destroy.php">ログアウト</a></li>
                </ul>
            </div>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>