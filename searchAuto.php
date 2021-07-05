<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Поиск</title>
</head>
<body>
<form action="" method="POST">
    <p>Введите  номер:<br>
        <input type="string" name="carNumber"><p><br>
        <input type="submit" value="Поиск">
        <button action="Показать историю"><a href="checkHistory.php">Показать_историю</a></button>
</form>
<?php
    if(isset($_POST["carNumber"])){
        $number = $_POST["carNumber"];
        file_put_contents("num.txt", $number);
        $y = "start main.exe";
        exec($y);
        $filename = "num.txt";
        $handle = fopen($filename, "r");
        $carNumber = fread($handle,filesize($filename));
        fclose($handle);
        $x = new mysqli("localhost", "root", "1234", "web");
        if ($x->connect_errno) {
            printf("Не удалось подключиться: %s\n", $x->connect_error);
        }
        $sql = "select `Name`,`idSearchCar` from `searchcar` where `Number_of_searches` = '$carNumber' ;";
        $result = $x->query($sql) or die('jjj');
        $row = $result->fetch_assoc();

        if (is_null($row)) {
            $n = "python main.py";
            popen($n, "r");
            $filename = "name.txt";
            $handle = fopen($filename, "r");
            $carName = fread($handle,filesize($filename));
            fclose($handle);
            printf("%s \n ", $carName);


            $sql = "INSERT INTO `searchcar` (`Name`,`Number_of_searches`) values ('$carName', '$carNumber')";
            $result = $x->query($sql) or die('jjj');

            $sql = "select `idSearchCar` from `searchcar` where `Number_of_searches` = '$carNumber' and `Name` = '$carName';";
            $result = $x->query($sql) or die('jjj');
            $row = $result->fetch_assoc();
        } else {
            echo $row['Name'];
        }
        session_start();
        $userId = $_SESSION['idUser'];
        $newId = $row['idSearchCar'];
        $timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `search` (`Date_of_search`,`SearchCar_idSearchCar`,`User_idUser`) values ('$timestamp','$newId', '$userId')";
        $result = $x->query($sql) or die('jjj');
    }
?>
</body>
</html>