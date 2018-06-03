<?php
require_once 'connection.php';
/*$host='mysql'; // имя хоста (уточняется у провайдера)
$database='k3143_zha'; // имя базы данных, которую вы должны создать
$user='root'; // заданное вами имя пользователя, либо определенное провайдером
$pswd='1234'; // заданный вами пароль */

$dbh = mysqli_connect($host, $user, $pswd, $database) or die("Не могу соединиться с MySQL." . mysqli_error());  //mysqli_error()-  Возвращает строку ошибки последней операции с MySQL. 

echo "Успешное подключение<br>";

$name = strtr(trim($_GET['name']),'*', '%'); //Translate characters or replace substrings string strtr ( string $str , string $from , string $to )
$id_ceh = strtr(trim($_GET['id_ceh']), '*', '%');

echo "<p align=center>Информация о курицах по породе и цеху</p>
	<form method='GET' action='search.php'>
		<div><fieldset>
			<div><legend>Введите данные</legend></div>
			<div><label>Название породы<input type='text' name='name'  value = '$name'></label></div>
			<div><label>Номер цеха<input type='text' name='id_ceh'  value='$id_ceh'></label></div>
			<button type='submit' name='enter' value='send'>Найти</button> 
		</fieldset></div>
	</form>";

if(isset($_GET['enter'])){
$query = "SELECT id_kurica, name, kletka.id_kletka, ceh.id_ceh
	FROM kurica, kletka, ceh
	WHERE kurica.id_kletka = kletka.id_kletka AND kletka.id_ceh = ceh.id_ceh AND kurica.name LIKE '%$name%' AND ceh.id_ceh LIKE '%$id_ceh%' ";
if (mysqli_query($dbh, $query)) {
  echo "Запрос произведён<br>";
} else {
  echo "Ошибка запроса <br>" . mysqli_error($dbh);
}

$res = mysqli_query($dbh, $query);

echo "<table border=1 align=center>
		<tr>
			<td>ID-курицы</td><td>Порода</td><td>ID-клетки</td><td>ID-цеха</td>
		</tr>";

while($row = mysqli_fetch_array($res))
{
	echo "<tr>
			<td>".$row['id_kurica']."</td><td>".$row['name']."</td><td>".$row['id_kletka']."</td><td>".$row['id_ceh']."</td>
		</tr>";
}

echo "</table>";
}
mysqli_close($dbh);
?>