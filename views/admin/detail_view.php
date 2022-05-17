<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require __DIR__ . '/_head.php'; ?>
    <title><?= $admin['name']; ?>詳細画面</title>
</head>

<body>
    <header>
        <!-- ナビゲーションバー -->
        <?php require __DIR__ . '/_admin_navgation.php'; ?>
    </header>
    <main>
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-5">
                    <?php if (isset($admin['file_name'])) { ?>
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="../../img/<?= h($admin['file_name']); ?>" style="width: 300px;" class="mx-auto" alt="">
                        </div>
                    <?php } else { ?>
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="../../img/default_french-bulldog-g024d2a019_1920.png" style="width: 300px;" class="mx-auto" alt="">
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-7">
                    <div class="">
                        <label for="">社員ID</label>
                        <p><?= h($admin['id']); ?></p>
                        <hr>
                        <label for="">氏名</label>
                        <p><?= h($admin['name']); ?></p>
                        <hr>
                        <label for="">年齢</label>
                        <p><?= h($admin['age']); ?></p>
                        <hr>
                        <label for="">メールアドレス</label>
                        <p class="me-5">
                            <?php $account_id = get_account_id() ?>
                            <?php if ($account_id === $admin['id']) { ?>
                                <?= h($admin['email']); ?>
                            <?php } else { ?>
                                <a href="mail.php?admin_id=<?= h($admin['id']); ?>">
                                    <?= h($admin['email']); ?>
                                </a>
                            <?php } ?>
                        </p>
                        <hr>
                        <label for="">電話番号</label>
                        <p><?= h($admin['tell_number']); ?></p>
                        <hr>
                        <label for="">部署</label>
                        <p><?= h($admin['department_name']); ?></p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <form action="delete.php" method="POST" onSubmit="return check()">
                    <input type="hidden" name="id" value="<?= h($admin['id']); ?>">
                    <input type="hidden" name="csrf_token" value="<?= h($csrf_token); ?>">
                    <input type="submit" class="btn btn-danger ps-4 pe-4 ms-5" id="button1" value="削除">
                </form>
                <form action="update.php" method="GET">
                    <input type="hidden" name="id" value="<?= h($admin['id']); ?>">
                    <button class="btn btn-primary ps-4 pe-4 ms-5 me-5">更新</button>
                </form>

            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</body>

<script type="text/javascript">
    function check() {
        if (window.confirm('削除してよろしいですか？')) { // 確認ダイアログを表示
            return true; // 「OK」時は送信を実行
        } else { // 「キャンセル」時の処理
            window.alert('キャンセルされました'); // 警告ダイアログを表示
            return false; // 送信を中止
        }
    }
</script>

</html>