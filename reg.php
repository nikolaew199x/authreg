<?php
    require "db.php";

    $data = $_POST;

    if(isset($data['onreg'])) {
        $errors = array();

        if(trim($data['login']) == '' ) {
            $errors[] = 'Введите имя';
        }

        if(trim($data['email']) == '' ) {
            $errors[] = 'Введите электронный адрес';
        }

        if($data['password'] == '' ) {
            $errors[] = 'Введите пароль';
        }

        if($data['password'] != $data['passwordtwo']) {
            $errors[] = 'Пароль подтвержден неверно';
        }
        
        if( R::count('users', "login = ?", array($data['login'])) > 0) {
            $errors[] = 'Пользователь с таким именем уже существует';
        }
        
        if( R::count('users', "email = ?", array($data['email'])) > 0) {
            $errors[] = 'Пользователь с таким электронным адресом уже существует!';
        }

        if(empty($errors)) {
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            R::store($user);
            header('location: success.php');
        } else  {         
            echo '<div style="color:red;text-transform:uppercase;text-align:center; ">Ошибка: '.array_shift($errors).'!</div>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/regstyle.css">
    <title>Task</title>
</head>
<body>
    <div class="center">
        <div class="headline">
            <h1>Создать новый аккаунт</h1>
        </div>
        <form action="/reg.php" method="POST">
            <p>
                <label for="login">Имя</label>
                <input type="text" id="login" name="login" value="<?php echo @$data['login']; ?>">
            </p>
            <p>
                <label for="email">Электронный <br> адрес</label>
                <input type="email" id="email" name="email" value="<?php echo @$data['email']; ?>">
            </p>
            <p>
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" >
            </p>
            <p>
                <label for="passwordtwo">Подтвердить <br> пароль</label>
                <input type="password" id="passwordtwo" name="passwordtwo">
            </p>
            <a href="/index.php">Перейти в меню входа?</a>
            <p>
                <button type="submit" name="onreg">Регистрация</button>
            </p>
        </form>
    </div>
</body>
</html>
