<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require __DIR__ . '/../_head.php'; ?>
    <title>社員情報更新</title>
</head>

<body>
    <header>
        <!-- ナビゲーションバー -->
        <?php require __DIR__ . '/_admin_user_contents_navgation.php'; ?>
    </header>
    <main class="container py-4">
        <?php require __DIR__ . '/../../_message_view.php'; ?>
        <div class="row mt-3">
            <div class="col-6">
                <h3>社員情報更新</h3>
                <hr>
                <form action="update_confirm.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="csrf_token" value="<?= h($csrf_token); ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= h($user['name']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email" class="mt-1">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= h($user['email']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="age" class="mt-1">Age</label>
                        <input type="number" class="form-control" id="age" name="age" value="<?= h($user['age']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="tell_number" class="mt-1">Tell_number</label>
                        <input type="text" class="form-control" id="tell_number" name="tell_number" value="<?= h($user['tell_number']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="mt-1">Department</label>
                        <select name="department_id" class="form-control" id="department_id">
                            <?php foreach ($departments as $department) { ?>
                                <option value="<?= $department['id'] ?>" <?= $department['id'] === $user['department_id'] ? 'selected' : '' ?>><?= $department['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image_file" class="mt-1">Image_file</label>
                        <input type="file" class="form-control" id="image_file" name="image_file">
                    </div>
                    <div class="form-group">
                        <label for="password" class="mt-1">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-secondary mt-3 mb-5">確認</button>
                </form>
            </div>
            <hr>
            <div class="col-6">
                <form action="csv_inport.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="inport_csv" class="form-control">
                    <input type="hidden" name="csrf_token" value="<?= h($csrf_token); ?>">
                    <input type="submit" class="btn btn-secondary mt-3 mb-2" value="csv読み込み">
                    <div>
                        <a href="csv_default_download.php">フォーマットをダウンロード</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</body>

</html>