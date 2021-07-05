<!DOCTYPE html>
<html lang="ru">
<head>
    <!--<link rel="stylesheet" href="style.css">-->
    <meta charset="utf-8">
    <title>Вход</title>
</head>
<body>
<form action="" method="POST">
    <p>Введите логин:<br>
        <input type="string" name="login" /></p>
    <p>Введите пароль:<br>
        <input type="string" name="password"><p><br>
        <input type="submit" value="Войти">
        <button action="Регистрация"><a href="reg.php">Регистрация</a></button>
</form>
<?php
    if(isset($_POST["login"])&&isset($_POST["password"])){
        $login_input = $_POST['login'];
        $password_input = $_POST['password'];
        $x = new mysqli("localhost", "root", "1234", "web");
        if ($x->connect_errno) {
            printf("Не удалось подключиться: %s\n", $x->connect_error);
        }
        $sql = "select `idUser` from `user` where `Login` = '$login_input' and `Pasword` = '$password_input';";
        $result = $x->query($sql) or die('jjj');
        $row = $result->fetch_assoc();
        if (is_null($row)) {
            echo ("Пользователь не найден \n Если у вас нет аккаунта, просим вас зарегистрироваться");
        }
        else {
            echo $row['idUser'];
            session_start();
            $_SESSION['idUser']= $row['idUser'];
            header('Location: searchAuto.php');
        }

    }
?>
</body>
</html>