<?php
    require "db.php";
    
    $data = $_POST;
    
    if(isset($data['onlog'])) {
        $errors = array();
        $user = R::findOne('users', 'login = ?', array($data['login']));

        if($user) { 
          
            if(password_verify($data['password'], $user->password)) {
                $_SESSION['login_user'] = $user;
                header('location: account.php');
            } else {
                $errors[] = 'Неверно введен пароль';
            }
        } else {
            $errors[] = 'Пользователь с таким именем не найден';
        }

        if(!empty($errors)) {
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
  <link rel="stylesheet" href="assets/css/indexstyle.css">
  <title>Task</title>
</head>
<body>
<div class="center">
  <div>
    <div class="headline">
      <h1>Вход</h1>
    </div>
  </div>
  <form action="/index.php" method="POST">
    <p>
        <label for="login">Имя</label>
        <input type="text" id="login" name="login" value="<?php echo $data['login']; ?>">
    </p>
    <p>
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" >
    </p>
    <a href="/reg.php">Создать новый аккаунт?</a>
    <p>
        <button type="submit" name="onlog">Войти</button>
    </p>
  </form>
</div>
</body>
</html>
