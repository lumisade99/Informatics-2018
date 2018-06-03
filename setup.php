<?php
require_once 'connection.php';
/*$host='mysql'; // имя хоста (уточняется у провайдера)
$database='k3143_zha'; // имя базы данных, которую вы должны создать
$user='root'; // заданное вами имя пользователя, либо определенное провайдером
$pswd='1234'; // заданный вами пароль */
 
$dbh = mysqli_connect($host, $user, $pswd, $database) or die("Не могу соединиться с MySQL." . mysqli_error());  //mysqli_error()-  Возвращает строку ошибки последней операции с MySQL. 

echo "Успешное подключение<br>";

$ceh = "CREATE TABLE ceh (
  id_ceh int(11) NOT NULL AUTO_INCREMENT,
  colvo_kletok int(11) NOT NULL,
  max_colvo_kuric int(11) NOT NULL,
  colvo_rabotnikov int(11) NOT NULL,
  PRIMARY KEY (id_ceh)) ENGINE=MyISAM"; //ENGINE=MyISAM - тип таблицы, применяемый в MySQL по умолчанию
if (mysqli_query($dbh, $ceh)) {          //mysqli_query() -посылает запрос к базе данных и возвращает в случае успешного обращения идентификатор ресурса
echo "Table
created successfully";
} else {
echo "Error 
creating table: <br>" . mysqli_error($dbh);
}

/*
$query = "SELECT * FROM `ceh`"; 
$res = mysql($query);

while($row = mysql_fetch_array($res))
{
echo "Номер цеха: ".$row['id_ceh']."<br>\n";
echo "Кол-во клеток: ".$row['colvo_kletok']."<br>\n";
echo "Макс кол-во куриц: ".$row['colvo_rabotnikov']."<br>\n";
echo "Макс кол-во куриц: ".$row['colvo_rabotnikov']."<br><hr>\n";
}
*/

$ceh = "INSERT INTO ceh VALUES
  ('1', '30', '100', '30'),
  ('2', '40', '40', '40'),
  ('3', '50', '50', '50')";
if (mysqli_query($dbh, $ceh)) {
  echo "Created successfully<br>";
} else {
  echo "Error creating <br>" . mysqli_error($dbh);
}

$rabotnik = "CREATE TABLE rabotnik(
  FIO_rabotnika varchar(255) NOT NULL,
  zarplata text NOT NULL,
  pasp_data int(11) NOT NULL,
  PRIMARY KEY(FIO_rabotnika)) ENGINE=MyISAM";
if (mysqli_query($dbh, $rabotnik)) {
echo "Table
created successfully";
} else {
echo "Error 
creating table: <br>" . mysqli_error($dbh);
}

$rabotnik = "INSERT INTO rabotnik VALUES
  ('Гаечкин Т.О.', '20000', '1111'),
  ('Иванов Т.О.', '10000', '2222'),
  ('Петров Т.О.', '15000', '3333'),
  ('Сидоров Т.О.', '30000', '4444')";
if (mysqli_query($dbh, $rabotnik)) {
  echo "Created successfully<br>";
} else {
  echo "Error creating <br>" . mysqli_error($dbh);
}

$kletka = "CREATE TABLE kletka (
  id_kletka int(11) NOT NULL AUTO_INCREMENT,
  id_ceh int(11) NOT NULL,
  nomer_ryada int(11) NOT NULL,
  PRIMARY KEY (id_kletka),
  FOREIGN KEY (id_ceh) REFERENCES ceh (id_ceh)) ENGINE=MyISAM";
if (mysqli_query($dbh, $kletka)) {
echo "Table
created successfully";
} else {
echo "Error 
creating table: <br>" . mysqli_error($dbh);
}

$kletka = "INSERT INTO kletka VALUES
  ('1', '1', '1'),
  ('2', '1', '2'),
  ('3', '1', '3'),
  ('4', '2', '3'),
  ('5', '2', '2'),
  ('6', '2', '1'),
  ('7', '3', '1'),
  ('8', '3', '2'),
  ('9', '3', '3')";
if (mysqli_query($dbh, $kletka)) {
  echo "Created successfully<br>";
} else {
  echo "Error creating <br>" . mysqli_error($dbh);
}

$inf = "CREATE TABLE info_ob_obsl_kletok (
  FIO_rabotnika varchar(255) NOT NULL,
  id_kletka int(11) NOT NULL,
  raspisanie text NOT NULL,
  FOREIGN KEY (FIO_rabotnika) REFERENCES rabotnik (FIO_rabotnika),
  FOREIGN KEY (id_kletka) REFERENCES kletka (id_kletka)) ENGINE=MyISAM";
if (mysqli_query($dbh, $inf)) {
echo "Table
created successfully";
} else {
echo "Error 
creating table: <br>" . mysqli_error($dbh);
}

$inf = "INSERT INTO info_ob_obsl_kletok VALUES
  ('Гаечкин Т.О.', '1', 'Пн-Вт'),
  ('Иванов Т.О.', '2', 'Пн-Вт'),
  ('Петров Т.О.', '3', 'Ср-Чт'),
  ('Сидоров Т.О.', '4', 'Пт-Вс'),
  ('Сидоров Т.О.', '5', 'Пн-Чт'),
  ('Петров Т.О.', '6', 'Пн-Вт'),
  ('Иванов Т.О.', '7', 'Ср-Пт'),
  ('Гаечкин Т.О.', '8', 'Пн-Вт'),
  ('Гаечкин Т.О.', '9', 'Сб-Вс')";
if (mysqli_query($dbh, $inf)) {
  echo "Created successfully<br>";
} else {
  echo "Error creating <br>" . mysqli_error($dbh);
}

$poroda = "CREATE TABLE poroda (
  name varchar(255) NOT NULL,
  ves int(11) DEFAULT NULL,
  sr_kolvo_yaiz int(11) DEFAULT NULL,
  rost int(11) DEFAULT NULL,
  PRIMARY KEY (name)) ENGINE=MyISAM";
if (mysqli_query($dbh, $poroda)) {
echo "Table
created successfully";
} else {
echo "Error 
creating table: <br>" . mysqli_error($dbh);
}

$poroda = "INSERT INTO poroda VALUES
  ('Брама', '2', '2', '20'),
  ('Барбезье', '3', '5', '20'),
  ('Геркулес', '4', '5', '20'),
  ('Доминант', '5', '5', '20'),
  ('Леггорн', '1', '3', '15')";
if (mysqli_query($dbh, $poroda)) {
  echo "Created successfully<br>";
} else {
  echo "Error creating <br>" . mysqli_error($dbh);
}

$kurica = "CREATE TABLE kurica(
  id_kurica int(11) NOT NULL AUTO_INCREMENT,
  id_kletka int(11) NOT NULL,
  name varchar(255) NOT NULL,
  vozrast int(11) DEFAULT NULL,
  PRIMARY KEY (id_kurica),
  FOREIGN KEY (id_kletka) REFERENCES kletka(id_kletka),
  FOREIGN KEY (name) REFERENCES poroda(name)) ENGINE=MyISAM";
if (mysqli_query($dbh, $kurica)) {
echo "Table
created successfully";
} else {
echo "Error 
creating table: <br>" . mysqli_error($dbh);
}

$kurica = "INSERT INTO kurica VALUES
  ('1', '1', 'Геркулес', '1'),
  ('2', '1', 'Геркулес', '2'),
  ('3', '2', 'Брама', '1'),
  ('4', '2', 'Барбезье', '1'),
  ('5', '3', 'Доминант', '1'),
  ('6', '4', 'Леггорн', '1'),
  ('7', '5', 'Брама', '1'),
  ('8', '5', 'Геркулес', '1'),
  ('9', '5', 'Доминант', '1'),
  ('10', '6', 'Барбезье', '1'),
  ('11', '7', 'Брама', '1'),
  ('12', '7', 'Леггорн', '1'),
  ('13', '7', 'Геркулес', '1'),
  ('14', '7', 'Леггорн', '1'),
  ('15', '8', 'Брама', '1'),
  ('16', '9', 'Доминант', '1'),
  ('17', '9', 'Брама', '1'),
  ('18', '9', 'Барбезье', '1'),
  ('19', '9', 'Барбезье', '1'),
  ('20', '9', 'Барбезье', '1')";
if (mysqli_query($dbh, $kurica)) {
  echo "Created successfully<br>";
} else {
  echo "Error creating <br>" . mysqli_error($dbh);
}

$proizv_k = "CREATE TABLE proizv_k(
  id_proizv int(11) NOT NULL,
  id_kurica int(11) NOT NULL,
  kolvo_yaic_v_den int(11) NOT NULL,
  PRIMARY KEY (`id_proizv`),
  FOREIGN KEY (`id_kurica`) REFERENCES `kurica` (`id_kurica`)) ENGINE=MyISAM";
if (mysqli_query($dbh, $proizv_k)) {
echo "Table
created successfully";
} else {
echo "Error 
creating table: <br>" . mysqli_error($dbh);
}

$proizv_k = "INSERT INTO proizv_k VALUES
  ('1', '1', '1'),
  ('2', '2', '2'),
  ('3', '3', '3'),
  ('4', '4', '2'),
  ('5', '5', '3'),
  ('6', '6', '4'),
  ('7', '7', '4'),
  ('8', '8', '1'),
  ('9', '9', '2'),
  ('10', '10', '2'),
  ('11', '11', '1'),
  ('12', '12', '3'),
  ('13', '13', '2'),
  ('14', '14', '3'),
  ('15', '15', '3'),
  ('16', '16', '4'),
  ('17', '17', '2'),
  ('18', '18', '1'),
  ('19', '19', '2'),
  ('20', '20', '5')";
if (mysqli_query($dbh, $proizv_k)) {
  echo "Created successfully<br>";
} else {
  echo "Error creating <br>" . mysqli_error($dbh);
}


mysqli_close($dbh);
?>