<!-- header -->
<?php include(__DIR__ . '/header.view.php'); ?>

<body>
    <div class="container">
        <h1 class="main-title">社員一覧</h1>
        <div class="main-content">
            <div class="search-area mb-4">
                <form action="" method="get">
                    <label for="name" class="font-weight-bold">氏名</label>
                    <input id="name" name="name" type="text" class="p-1" value="<?php echo $request->name; ?>">

                    <label for="gender" class="font-weight-bold">性別</label>
                    <select name="gender" id="gender" class="pr-1 pl-1 pt-2 pb-2">
                        <option value="">全て</option>
                        <option value="1" <?php echo $request->gender === 1 ? 'selected' : "" ?>>男</option>
                        <option value="2" <?php echo $request->gender === 2 ? 'selected' : "" ?>>女</option>
                        <option value="9" <?php echo $request->gender === 9 ? 'selected' : "" ?>>不明</option>
                    </select>

                    <button class="btn">検索</button>
                </form>
            </div>
            <?php /** @var array<Employee> $employees */ ?>
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

                <?php if ($paginate['total_count'] > self::DEFAULT_PER_PAGE) : ?>
                    <div class="pagination">
                        <p><?php echo $paginate['total_count']; ?>件中 <?php echo $paginate['from']; ?> - <?php echo $paginate['to']; ?>件目を表示</p>
                        <div>
                            <!-- 前へボタン -->
                            <?php if ($request->page > 1) : ?>
                                <a href="?page=<?php echo $request->page - 1 ?>">&lt;&lt;</a>
                            <?php else : ?>
                                <span>&lt;&lt;</span>
                            <?php endif; ?>

                            <!-- ページ番号 -->
                            <?php for ($i = 1; $i <= $paginate['page_count']; ++$i) : ?>
                                <?php if ($i === $request->page) : ?>
                                    <span><?php echo $i; ?></span>
                                <?php else : ?>
                                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <!-- 次へボタン -->
                            <?php if ($request->page === $paginate['page_count']) : ?>
                                <span>&gt;&gt;</span>
                            <?php else : ?>
                                <a href="?page=<?php echo $request->page + 1 ?>">&gt;&gt;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div>
                    <p>※ 該当する社員が見つかりませんでした。</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
