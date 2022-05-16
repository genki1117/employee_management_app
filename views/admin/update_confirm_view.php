<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require __DIR__ . '/../../views/admin/_head.php'; ?>
    <title>管理者登録</title>
</head>

<body>
    <header>
        <!-- ナビゲーションバー -->
        <?php require __DIR__ . '/_admin_navgation.php'; ?>
    </header>
    <main class="container py-4">
        <div class="row mt-3">
            <div class="col-6">
                <h3>管理者登録</h3>
                <hr>
                <form action="update_confirm_post.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= h($csrf_toke_regenerate); ?>">
                    <input type="hidden" name="id" value="<?= h($_POST['id']); ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <h5><?= h($_POST['name']); ?></h5>
                        <input type="hidden" class="form-control" id="name" name="name" value="<?= h($_POST['name']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email" class="mt-1">Email</label>
                        <h5><?= h($_POST['email']); ?></h5>
                        <input type="hidden" class="form-control" id="email" name="email" value="<?= h($_POST['email']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="age" class="mt-1">Age</label>
                        <h5><?= h($_POST['age']); ?></h5>
                        <input type="hidden" class="form-control" id="age" name="age" value="<?= h($_POST['age']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="tell_number" class="mt-1">Tell_number</label>
                        <h5><?= h($_POST['tell_number']); ?></h5>
                        <input type="hidden" class="form-control" id="tell_number" name="tell_number" value="<?= h($_POST['tell_number']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="department_id" class="mt-1">Department</label>
                        <h5><?= h($_POST['department_name']); ?></h5>
                        <input type="hidden" class="form-control" id="department_id" name="department_id" value="<?= h($_POST['department_id']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="image_file" class="mt-1">Image_file</label>
                        <?php if ($_FILES['image_file']['name'] !== '') { ?>
                            <p>
                                <img src="<?= h($file_path . $image_file_name) ?>" width="200px" alt="">
                            </p>
                        <?php } ?>
                        <input type="hidden" class="form-control" id="image_file" name="image_file_name" value="<?= h($image_file_name); ?>">
                    </div>
                    <div class="form-group">
                        <label for="password" class="mt-1">Password</label>
                        <input type="hidden" class="form-control" id="password" name="password" value="<?= h($_POST['password']); ?>">
                    </div>
                    <div class="d-flex">
                        <input value="前に戻る" onclick="history.back();" type="button" class="btn btn-danger mt-3 ms-">
                        <button type="submit" class="btn btn-secondary mt-3 ms-5">登録</button>
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