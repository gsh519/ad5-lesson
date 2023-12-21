<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AD5 Lesson</title>
    <link rel="stylesheet" href="./resources/css/reset.css">
    <link rel="stylesheet" href="./resources/css/style.css">
</head>

<body>
    <div class="container">
        <h1 class="main-title">社員一覧</h1>
        <div class="main-content">
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
                    <?php /** @var array<Employee> $employees */ ?>
                    <?php foreach ($employees as $employee) : ?>
                        <tr>
                            <td><?php echo $employee->employee_name; ?></td>
                            <td><?php echo $employee->employee_name_kana; ?></td>
                            <td><?php echo $employee->gender_label; ?></td>
                            <td><?php echo $employee->age; ?></td>
                            <td><?php echo $employee->birthday_label; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
