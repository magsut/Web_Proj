<!DOCTYPE html>
<html lang="ru">
<head>
    <!--<link rel="stylesheet" href="style.css">-->
    <meta charset="utf-8">
    <title>Регистрация</title>
</head>
<body>
<form action="" method="POST">
    <p>Введите логин:<br>
        <input type="string" name="login" /></p>
    <p>Введите пароль:<br>
        <input type="string" name="password"><p>
    <p>Повторите пароль:<br>
        <input type="string" name="passwordCheck"><p><br>
        <input type="submit" value="Создать аккаунт">
        <button action="Назад"><a href="index.php">Назад</a></button>
</form>
<?php
if(isset($_POST["login"])&&isset($_POST["password"])){
    $login_input = $_POST['login'];
    $password_input = $_POST['password'];
    $password_input_check = $_POST['passwordCheck'];
    $x = new mysqli("localhost", "root", "1234", "web");
    if ($x->connect_errno) {
        printf("Не удалось подключиться: %s\n", $x->connect_error);
    }
    if($password_input != $password_input_check){
        echo ("Пароли не совпадают");
    } else {
        $sql = "select `idUser` from `user` where `Login` = '$login_input' and `Pasword` = '$password_input';";
        $result = $x->query($sql) or die('jjj');
        $row = $result->fetch_assoc();

        if (is_null($row)) {
            $sql = "INSERT INTO `user` (`Login`,`Pasword`) values ('$login_input', '$password_input')";
            $result = $x->query($sql) or die('jjj');

            $sql = "select `idUser` from `user` where `Login` = '$login_input' and `Pasword` = '$password_input';";
            $result = $x->query($sql) or die('jjj');
            $row = $result->fetch_assoc();

            if (is_null($row)) {
                echo ("Произошла ошибка:( \n Попробуйте ещё раз!");
            }
            else {
                //echo $row['idUser'];
                echo("Аккаунт создан");
            }
        }
        else {
            echo ("Такой пользователь уже существует!");
        }
    }
}
?>
</body>
</html>