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
            <!-- フラッシュメッセージ表示 -->
            <?php if (isset($flash['success'])) : ?>
                <p class="text-green mb-2"><?php echo $flash['success']; ?></p>
            <?php elseif (isset($flash['error'])) : ?>
                <p class="text-red mb-2"><?php echo $flash['error']; ?></p>
            <?php endif; ?>
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
