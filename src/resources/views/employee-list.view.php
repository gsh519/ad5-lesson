<?php

/** @var FetchRequest $request */
/** @var array<Employee> $employees */
/** @var array<string ,string> $flash */
?>

<!-- header -->
<?php include(__DIR__ . '/header.view.php'); ?>

<body>
    <div class="container">
        <h1 class="main-title">社員一覧</h1>
        <div class="main-content">
            <?php include(__DIR__ . '/flash-message.view.php'); ?>
            <div class="search-area mb-4">
                <form action="" method="get">
                    <div class="d-flex align-center">
                        <div class="d-flex align-center mr-4">
                            <label for="name" class="bold mr-2">氏名</label>
                            <input id="name" name="name" type="text" value="<?php echo $request->name; ?>">
                        </div>

                        <div class="d-flex align-center mr-4">
                            <label for="gender" class="bold mr-2">性別</label>
                            <select name="gender" id="gender">
                                <option value="">全て</option>
                                <option value="1" <?php echo $request->gender === 1 ? 'selected' : "" ?>>男</option>
                                <option value="2" <?php echo $request->gender === 2 ? 'selected' : "" ?>>女</option>
                                <option value="9" <?php echo $request->gender === 9 ? 'selected' : "" ?>>不明</option>
                            </select>
                        </div>

                        <div>
                            <button class="btn">検索</button>
                        </div>
                    </div>

                </form>
            </div>
            <?php if (count($employees) > 0) : ?>
                <table class="main-content__table">
                    <thead>
                        <tr>
                            <th>氏名</th>
                            <th>かな</th>
                            <th>性別</th>
                            <th>年齢</th>
                            <th>生年月日</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee) : ?>
                            <tr>
                                <td><?php echo $employee->employee_name; ?></td>
                                <td><?php echo $employee->employee_name_kana; ?></td>
                                <td><?php echo $employee->gender->label(); ?></td>
                                <td><?php echo $employee->age; ?></td>
                                <td><?php echo $employee->birthday_label; ?></td>
                                <td><a href="<?php echo '/employee-edit.php?employee_id=' . $employee->employee_id; ?>" class="btn">編集</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- ページネーション -->
                <?php include(__DIR__ . '/pagination.view.php'); ?>
            <?php else : ?>
                <div>
                    <p>※ 該当する社員が見つかりませんでした。</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
