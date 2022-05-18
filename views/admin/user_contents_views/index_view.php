<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require __DIR__ . '/../_head.php'; ?>
    <title>管理者ホーム</title>
</head>

<body>
    <header>
        <!-- ナビゲーションバー -->
        <?php require __DIR__ . '/_admin_user_contents_navgation.php'; ?>
    </header>
    <main>
        <div class="container mt-2">
            <?php require __DIR__ . '/../../_message_view.php'; ?>
            <table class="table caption-top table-sm table-striped">
                <caption>社員一覧</caption>
                <thead>
                    <tr>
                        <th scope="col" style="width: 4%">ID</th>
                        <th scope="col">氏名</th>
                        <th scope="col">年齢</th>
                        <th scope="col">電話番号</th>
                        <th scope="col">メールアドレス</th>
                        <th scope="col">部署</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <th scope="row"><?= h($user['id']); ?></th>
                            <td><?= h($user['name']); ?></td>
                            <td><?= h($user['age']); ?></td>
                            <td><?= h($user['tell_number']); ?></td>
                            <td><?= h($user['email']); ?></td>
                            <td><?= h($user['department_name']); ?></td>
                            <td>
                                <a href="detail.php?user_id=<?= h($user['id']); ?>">詳細</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="">
                <div>
                    <a href="csv_download_user.php">
                        csvダウンロード
                    </a>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>