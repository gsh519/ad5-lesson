<?php

/** @var Employee $employee */

?>

<!-- header -->
<?php include(__DIR__ . '/header.view.php'); ?>

<body>
    <div class="container">
        <h1 class="main-title">社員編集</h1>
        <div class="main-content">
            <!-- フラッシュメッセージ表示 -->
            <?php include(__DIR__ . '/flash-message.view.php'); ?>
            <div class="search-area mb-4">
                <form action="employee-edit.php" method="post">
                    <input type="hidden" name="employee_id" value="<?php echo isset($original['employee_id']) ? $original['employee_id'] : $employee->employee_id; ?>">
                    <!-- 氏名 -->
                    <div class="mb-5">
                        <label class="mb-2" for="employee_name">氏名<span>必須</span></label>
                        <input type="text" id="employee_name" name="employee_name" required value="<?php echo isset($original['employee_name']) ? $original['employee_name'] : $employee->employee_name; ?>">
                        <p class="text-red mt-1">
                            <?php if (isset($error_messages['employee_name'])) : ?>
                                <?php echo $error_messages['employee_name']; ?>
                            <?php endif; ?>
                        </p>
                    </div>

                    <!-- かな -->
                    <div class="mb-5">
                        <label class="mb-2" for="employee_name_kana">かな<span>必須</span></label>
                        <input type="text" id="employee_name_kana" name="employee_name_kana" required value="<?php echo isset($original['employee_name_kana']) ? $original['employee_name_kana'] : $employee->employee_name_kana; ?>">
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
                            <option value="1" <?php echo (isset($original['gender']) ? $original['gender'] : $employee->gender->value === 1) ? 'selected' : "" ?>>男</option>
                            <option value="2" <?php echo (isset($original['gender']) ? $original['gender'] : $employee->gender->value === 2) ? 'selected' : "" ?>>女</option>
                            <option value="9" <?php echo (isset($original['gender']) ? $original['gender'] : $employee->gender->value === 9) ? 'selected' : "" ?>>不明</option>
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
                        <input type="date" name="birthday" id="birthday" value="<?php echo isset($original['birthday']) ? $original['birthday'] : $employee->birthday; ?>">
                    </div>

                    <div>
                        <button class="btn">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
