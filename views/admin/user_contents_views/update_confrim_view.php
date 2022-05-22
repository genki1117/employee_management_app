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
                <form action="update_post.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= h($csrf_token); ?>">
                    <input type="hidden" name="id" value="<?= h($id); ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <h5><?= h($name); ?></h5>
                        <input type="hidden" class="form-control" id="name" name="name" value="<?= h($name); ?>">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <h5><?= h($email); ?></h5>
                        <input type="hidden" class="form-control" id="email" name="email" value="<?= h($email); ?>">
                    </div>
                    <div class="form-group">
                        <label for="age" class="mt-1">Age</label>
                        <h5><?= h($age); ?></h5>
                        <input type="hidden" class="form-control" id="age" name="age" value="<?= h($age); ?>">
                    </div>
                    <div class="form-group">
                        <label for="tell_number" class="mt-1">Tell_number</label>
                        <h5><?= h($tell_number); ?></h5>
                        <input type="hidden" class="form-control" id="tell_number" name="tell_number" value="<?= h($tell_number); ?>">
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="mt-1">Department</label>
                        <h5><?= h($departmentNameId['name']); ?></h5>
                        <input type="hidden" class="form-control" id="department_id" name="department_id" value="<?= h($departmentNameId['id']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="image_file" class="mt-1">Image_file</label>
                        <img src="../../../img/<?= h($file_name); ?>" width="200" class="mt-2 mb-2" alt="">
                        <input type="hidden" class="form-control" id="image_file" name="image_file" value="<?= h($file_name); ?>">
                    </div>
                    <div class="form-group">
                        <label for="password" class="mt-1">Password</label>
                        <h5>**********</h5>
                        <input type="hidden" class="form-control" id="password" name="password" value="<?= h($password); ?>">
                    </div>
                    <button type="submit" class="btn btn-secondary mt-3 mb-5">登録</button>
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