<?php
require_once 'connection.php';

$dbh = mysqli_connect($host, $user, $pswd, $database) or die("Не могу соединиться с MySQL." . mysqli_error());  //mysqli_error()-  Возвращает строку ошибки последней операции с MySQL. 

echo "Успешное подключение к БД<br>";

$query = "SELECT id_kurica, name, vozrast, kletka.id_kletka, ceh.id_ceh
	FROM kurica, kletka, ceh
	WHERE kurica.id_kletka = kletka.id_kletka AND kletka.id_ceh = ceh.id_ceh";
if (mysqli_query($dbh, $query)) {
  echo "Запрос произведён<br>";
} else {
  echo "Ошибка запроса <br>" . mysqli_error($dbh);
}

echo "<p align=center>Информация о курицах по птицефабрике</p>";

$res = mysqli_query($dbh, $query);

echo "<table border=1 align=center>
		<tr>
			<td>ID-курицы</td><td>Порода</td><td>Возраст</td><td>ID-клетки</td><td>ID-цеха</td><td>Изменить/Удалить</td>
		</tr>";

while($row = mysqli_fetch_array($res))
{
	echo "<tr>
			<td>".$row['id_kurica']."</td><td>".$row['name']."</td><td>".$row['vozrast']."</td><td>".$row['id_kletka']."</td><td>".$row['id_ceh']."</td>
			<td><a href= 'edit.php?id_kur=".$row['id_kurica']."'>Изменить</a>&nbsp;<a href= 'delete.php?id_kur=".$row['id_kurica']."'>Удалить</a></td>
		</tr>";
}

echo "<tr><td colspan='6' align='center'><form action='insert.php'><button type='submit' name='enter' value='send'>Новая запись</button></form></td></tr>";

echo "</table>";
mysqli_close($dbh);
?>