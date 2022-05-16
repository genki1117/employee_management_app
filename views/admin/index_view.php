<!DOCTYPE html>
<html lang="ja">

<head>
    <?php require __DIR__ . '/_head.php'; ?>
    <title>管理者ホーム</title>
</head>

<body>
    <header>
        <!-- ナビゲーションバー -->
        <?php require __DIR__ . '/_admin_navgation.php'; ?>
    </header>
    <main>
        <div class="container mt-2">
            <?php require __DIR__ . '/../_message_view.php'; ?>
            <table class="table caption-top table-sm table-striped">
                <caption>管理者一覧</caption>
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
                    <?php foreach ($admins as $admin) { ?>
                        <tr>
                            <th scope="row"><?= h($admin['id']); ?></th>
                            <td><?= h($admin['name']); ?></td>
                            <td><?= h($admin['age']); ?></td>
                            <td><?= h($admin['tell_number']); ?></td>
                            <td><?= h($admin['email']); ?></td>
                            <td><?= h($admin['department_name']); ?></td>
                            <td>
                                <a href="detail.php?admin_id=<?= h($admin['id']); ?>">詳細</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="">
                        <div>
                            <a href="csv_download.php">
                                csvダウンロード
                            </a>
                        </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>