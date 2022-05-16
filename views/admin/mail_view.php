<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require __DIR__ . '/_head.php'; ?>
    <title>メール作成</title>
</head>

<body>
    <header>
        <!-- ナビゲーションバー -->
        <?php require __DIR__ . '/_admin_navgation.php'; ?>
    </header>
    <main class="h-100 d-flex justify-content-center align-items-center">
        <div class="form-wrapper container mt-5">
            <form action="mail_confirm.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?= h($csrf_token); ?>">
                <div class="alert alert-success d-none" role="alert"></div>
                <div class="form-title border-bottom mb-4">
                    <h4 class="">メール送信</h4>
                </div>
                <div class="form-row mb-2">
                    <lable for="from">From</lable>
                    <p><?= h($account_email); ?></p>
                    <input type="hidden" name="from" value="<?= h($account_email); ?>">
                </div>
                <div class="form-row mb-2">
                    <lable for="to">To</lable>
                    <p><?= h($admin['email']); ?></p>
                    <input type="hidden" name="to" id="to" value="<?= h($admin['email']); ?>">
                </div>
                <div class="form-row mb-2">
                    <lable for="subject">件名</lable>
                    <input type="text" name="subject" id="subject" class="bg-light form-control form-control-sm" required>
                </div>
                <div class="form-row mb-2">
                    <lable for="message">本文</lable>
                    <textarea name="message" id="message" cols="30" rows="10" class="bg-light form-control form-control-sm" required></textarea>
                </div>
                <div class="fomr-row mb-2">
                    <button type="submit" name="submit" class="btn py-2 btn-primary w-100">
                        確認
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script src="./js/main.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>