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
            <form action="mail_send.php" method="POST">
                <input type="hidden" name="csrf_token" value="<?= h($csrt_token_regenerate); ?>">
                <div class="alert alert-success d-none" role="alert"></div>
                <div class="form-title border-bottom mb-4">
                    <h4 class="">メール送信</h4>
                </div>
                <div class="form-row mb-2">
                    <lable for="from">From</lable>
                    <p><?= h($_POST['from']); ?></p>
                    <input type="hidden" name="from" value="<?= h($_POST['from']); ?>">
                </div>
                <div class="form-row mb-2">
                    <lable for="to">To</lable>
                    <p><?= h($_POST['to']); ?></p>
                    <input type="hidden" name="to" id="to" value="<?= h($_POST['to']); ?>">
                </div>
                <div class="form-row mb-2">
                    <lable for="subject">件名</lable>
                    <p><?= h($_POST['subject']); ?></p>
                    <input type="hidden" name="subject" value="<?= h($_POST['subject']); ?>">
                </div>
                <div class="form-row mb-2">
                    <lable for="message">本文</lable>
                    <p><?= h($_POST['message']); ?></p>
                    <input type="hidden" name="message" value="<?= h($_POST['message']); ?>">
                </div>
                <div class="fomr-row mb-2">
                    <input value="前に戻る" onclick="history.back();" type="button" class="btn btn-danger py-2 mt-3">
                    <button type="submit" name="submit" class="btn py-2 px-4 ms-3 mt-3 btn-primary">
                        送信
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script src="./js/main.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>