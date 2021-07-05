<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Истоия</title>
</head>
<body>
<form action="" method="POST">
        <button action="Вернуться к поиску"><a href="searchAuto.php">Вернуться к поиску</a></button>
</form>
<?php
    session_start();
    $userId = $_SESSION['idUser'];
    $x = new mysqli("localhost", "root", "1234", "web");
    $sql = "select searchcar.Name, searchcar.Number_of_searches, search.Date_of_search from search inner join searchcar on search.User_idUser = '$userId' and search.SearchCar_idSearchCar = searchcar.idSearchCar;";
    if ($x->connect_errno) {
        printf("Не удалось подключиться: %s\n", $x->connect_error);
    }
    $result = $x->query($sql) or die('Нет ответа');
    echo "Вы искали: \n";
    while ($row = $result->fetch_assoc())
    {
        printf("%s %s %s \n", $row['Name'], $row['Number_of_searches'], $row['Date_of_search']);
        echo "\n";
    }

?>
</body>
</html>