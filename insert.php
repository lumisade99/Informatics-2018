<?php
require_once 'connection.php';
/*$host='mysql'; // имя хоста (уточняется у провайдера)
$database='k3143_zha'; // имя базы данных, которую вы должны создать
$user='root'; // заданное вами имя пользователя, либо определенное провайдером
$pswd='1234'; // заданный вами пароль */

$dbh = mysqli_connect($host, $user, $pswd, $database) or die("Не могу соединиться с MySQL." . mysqli_error());  //mysqli_error()-  Возвращает строку ошибки последней операции с MySQL. 

if(isset($_GET['enter'])){
	$query2 = "SELECT DISTINCT name FROM kurica";
	$res2 = mysqli_query($dbh, $query2);			

	$query3 = "SELECT DISTINCT id_kletka FROM kletka"; 
	$res3 = mysqli_query($dbh, $query3);

	$query4 = "SELECT DISTINCT id_ceh FROM ceh"; 
	$res4 = mysqli_query($dbh, $query4);

	echo "<p align=center><u>Информация по новой курице</u></p>
	<p align=center><i>(без изменения цеха у клетки)</i></p>
	<form method='GET' action='insert.php' align=center>
	<p>Выберите породу:&nbsp;<select name='name'>";
	while($row2 = mysqli_fetch_array($res2)) {
	echo "<option name='name'>".$row2['name']."</option>";
	}

	echo "</select></p>
	<p>Введите возраст:&nbsp;<input type='text' name='vozrast' size=8</p>

	<p>Выберите клетку:&nbsp;<select name='id_kletka'>";
	while($row3 = mysqli_fetch_array($res3)) {
		echo "<option name='id_kletka'>".$row3['id_kletka']."</option>";
	}
	echo "</select></p>
		<button type='submit' name='new' value='send'>Добавить курицу</button></form>";

}
	if(isset($_GET['new'])){
		$name = trim($_GET['name']);
		$vozrast = trim($_GET['vozrast']);
		$id_kletka = trim($_GET['id_kletka']);
		echo $name;
		echo $vozrast;
		echo $id_kletka;
		$ins = "INSERT INTO kurica (id_kletka, name, vozrast) VALUES 
				('$id_kletka', '$name', '$vozrast') ";
		$prov = mysqli_query($dbh, $ins) or die("Ошибка" . mysqli_error($dbh));
		echo '<meta http-equiv="refresh" content="0; URL=list.php">';
	}

?>