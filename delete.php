<?php
require_once 'connection.php';
/*$host='mysql'; // имя хоста (уточняется у провайдера)
$database='k3143_zha'; // имя базы данных, которую вы должны создать
$user='root'; // заданное вами имя пользователя, либо определенное провайдером
$pswd='1234'; // заданный вами пароль */

$dbh = mysqli_connect($host, $user, $pswd, $database) or die("Не могу соединиться с MySQL." . mysqli_error());  //mysqli_error()-  Возвращает строку ошибки последней операции с MySQL. 

if(isset($_GET['id_kur'])){
$query = "DELETE FROM kurica WHERE id_kurica =" .$_GET['id_kur'];
$res = mysqli_query($dbh, $query);
echo '<meta http-equiv="refresh" content="0; URL=list.php">';
}
?>