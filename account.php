<?php
    require "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/accountstyle.css">
    <title>Task</title>
</head>
<body>
    <div class="center">
        <div class="headline">
            <h1>Вы успешно авторизованы!</h1>
            <p>Добро пожаловать <?php echo $_SESSION['login_user']->login; ?></p>
        </div>
        <table width="100%" class="profile">
            <tr>
                <th>Имя</th>
                <th>-</th>
                <th><?php echo $_SESSION['login_user']->login; ?></th>
            </tr>
            <tr>
                <th>Почта</th>
                <th>-</th>
                <th><?php echo $_SESSION['login_user']->email; ?></th>
            </tr>
        </table>
        <form action="/logout.php" method="POST">
            <button>Выйти</button>
        </form>
    </div>
</body>
</html>