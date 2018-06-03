<?php
require_once 'connection.php';
/*$host='mysql'; // имя хоста (уточняется у провайдера)
$database='k3143_zha'; // имя базы данных, которую вы должны создать
$user='root'; // заданное вами имя пользователя, либо определенное провайдером
$pswd='1234'; // заданный вами пароль */

$dbh = mysqli_connect($host, $user, $pswd, $database) or die("Не могу соединиться с MySQL." . mysqli_error());  //mysqli_error()-  Возвращает строку ошибки последней операции с MySQL. 

if(isset($_GET['id_kur'])){
	$query1 = "SELECT * FROM kurica WHERE id_kurica=".$_GET['id_kur'];
	$res1 = mysqli_query($dbh, $query1);
	$row1 = mysqli_fetch_array($res1);
	}

$query2 = "SELECT DISTINCT name FROM kurica";
$res2 = mysqli_query($dbh, $query2);			

$query3 = "SELECT DISTINCT id_kletka FROM kletka"; 
$res3 = mysqli_query($dbh, $query3);

$query4 = "SELECT DISTINCT id_ceh FROM ceh"; 
$res4 = mysqli_query($dbh, $query4);

$kur = $_GET['id_kur'];
echo "<p align=center><u>Ваши изменения</u></p>
	<form method='GET' action='edit.php' align=center>
		<input type='hidden' name='kur' value='$kur'>
		<p>Выберите породу:&nbsp;<select name='name'>
		<option name='name'>".$row1['name']."</option>";
while($row2 = mysqli_fetch_array($res2)) {
	echo "<option name='name'>".$row2['name']."</option>";
}

$vozrast = $row1['vozrast'];
echo "</select></p>
		<p>Введите возраст:&nbsp;<input type='text' name='vozrast' value='$vozrast' size=8</p>";

$query5 = "SELECT * FROM kurica INNER JOIN 
		(kletka INNER JOIN ceh ON kletka.id_ceh = ceh.id_ceh) ON kurica.id_kletka = kletka.id_kletka
WHERE id_kurica =".$_GET['id_kur'];
$res5 = mysqli_query($dbh, $query5);
$row5 = mysqli_fetch_array($res5);

echo 	"<p>Выберите клетку:&nbsp;<select name='id_kletka'>
		<option  name='id_kletka'>".$row5['id_kletka']."</option>";
while($row3 = mysqli_fetch_array($res3)) {
	echo "<option name='id_kletka'>".$row3['id_kletka']."</option>";
}
echo "</select></p>

		<p>Выберите цех:&nbsp;<select name='id_ceh'>
		<option name='id_ceh'>".$row5['id_ceh']."</option>";
while($row4 = mysqli_fetch_array($res4)) {
	echo "<option name='id_ceh'>".$row4['id_ceh']."</option>";
}
echo "</select></p>
		<button type='submit' name='enter' value='send'>Внести изменения</button>
		</form>";

if(isset($_GET['enter'])){
	$id_kurica = trim($_GET['kur']);
	$name = trim($_GET['name']);
	$vozrast = trim($_GET['vozrast']);
	$id_kletka = trim($_GET['id_kletka']);
	$id_ceh = trim($_GET['id_ceh']);

	$upd = "UPDATE kurica 
	SET name='$name', vozrast='$vozrast', id_kletka='$id_kletka'
	WHERE id_kurica ='$id_kurica'";
	$upd1 = "UPDATE kletka SET id_ceh='$id_ceh' WHERE id_kletka='$id_kletka'"; 
	$prov = mysqli_query($dbh, $upd) or die("Ошибка" . mysqli_error($dbh));

	echo '<meta http-equiv="refresh" content="0; URL=list.php">';

	}

?>