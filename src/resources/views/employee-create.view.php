<?php

/** @var array<string, string> $error_messages */
/** @var CreateRequest $request */
?>

<!-- header -->
<?php include('header.view.php'); ?>

<body>
    <div class="container">
        <div class="main-title d-flex align-center justify-space-between">
            <h1>社員登録</h1>
            <a href="/" class="outline-btn d-inline-block">戻る</a>
        </div>
        <div class="main-content">
            <div class="search-area mb-4">
                <form action="employee-create.php" method="post">
                    <!-- 氏名 -->
                    <div class="mb-5">
                        <label class="mb-2" for="employee_name">氏名<span>必須</span></label>
                        <input type="text" id="employee_name" name="employee_name" required value="<?php echo $request->employee_name; ?>">
                        <p class="text-red mt-1">
                            <?php if (isset($error_messages['employee_name'])) : ?>
                                <?php echo $error_messages['employee_name']; ?>
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- かな -->
                    <div class="mb-5">
                        <label class="mb-2" for="employee_name_kana">かな<span>必須</span></label>
                        <input type="text" id="employee_name_kana" name="employee_name_kana" required value="<?php echo $request->employee_name_kana; ?>">
                        <p class="text-red mt-1">
                            <?php if (isset($error_messages['employee_name_kana'])) : ?>
                                <?php echo $error_messages['employee_name_kana']; ?>
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- 性別 -->
                    <div class="mb-5">
                        <label class="mb-2" for="gender">性別</label>
                        <select name="gender" id="gender">
                            <option value="">選択</option>
                            <option value="1" <?php echo $request->gender === 1 ? 'selected' : "" ?>>男</option>
                            <option value="2" <?php echo $request->gender === 2 ? 'selected' : "" ?>>女</option>
                            <option value="9" <?php echo $request->gender === 9 ? 'selected' : "" ?>>不明</option>
                        </select>

                        <p class="text-red mt-1">
                            <?php if (isset($error_messages['gender'])) : ?>
                                <?php echo $error_messages['gender']; ?>
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- 生年月日 -->
                    <div class="mb-5">
                        <label class="mb-2" for="birthday">生年月日</label>
                        <input type="date" name="birthday" id="birthday" value="<?php echo $request->birthday; ?>">
                    </div>

                    <div>
                        <button class="btn">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
