<?php
//Функциональная модель страницы регистрации
include "../configs/db.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Регистрация</title>
</head>
<body>
	<!-- Форма для отправки данных -->
<form action="registr.php" method="post">
	<p>
	<input type="text" name="name" placeholder="Имя" autocomplete="off">
	</p>
	<p>
	<input type="text" name="surname" placeholder="Фамилия" autocomplete="off">
	</p>
	<p>
	<input type="text" name="phone_num" placeholder="Номер телефона" autocomplete="off">
	</p>
	<p>
	<input type="text" name="adress_user" placeholder="Адресс проживания" autocomplete="off">
	</p>
	<p>
	<input type="text" name="denomination" placeholder="Конфессия" autocomplete="off">
	</p>
	<p>
	<input type="text" name="church_name" placeholder="Название церкви" autocomplete="off">
	</p>
	<p>
	<input type="text" name="church_adress" placeholder="Адресс церкви" autocomplete="off">
	</p>
	<p>
	<input type="text" name="pastor_num" placeholder="Номер пастора" autocomplete="off">
	</p>
	<p>
	<input type="email" name="email" placeholder="е-маил">
	</p>
	<p>
	<input type="password" name="password" placeholder="пароь">
	</p>
	<button>Reg</button>
</form>
<!-- ссылка для  -->
<a href="auth.php">auth</a>

<?php
// Проверка на существование и заполненность всех полей в форме
if( 
	isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["phone_num"]) && isset($_POST["adress_user"]) && isset($_POST["denomination"]) &&
	isset($_POST["church_name"]) && isset($_POST["church_adress"]) && isset($_POST["pastor_num"]) && isset($_POST["email"]) && isset($_POST["password"])

  && $_POST["name"] != "" && $_POST["surname"] != "" && $_POST["phone_num"] != "" && $_POST["adress_user"] != ""  && $_POST["denomination"] != ""
	 && $_POST["church_name"] != ""  && $_POST["church_adress"] != ""  && $_POST["pastor_num"] != ""  && $_POST["email"] != ""  && $_POST["password"] != "" 
	){
  	
  	// Сравнение полученных данный с формы с данными в БД
	$sql = "SELECT * FROM register WHERE email LIKE '" . $_POST['email'] . "' OR phone_num LIKE '" . $_POST['phone_num'] . "' ";
    	$result = mysqli_query($connect, $sql);
    	$row = mysqli_fetch_assoc($result);
    // Проверка на совпадение по номеру телефона и емайлу
    if ($_POST['email'] == $row['email'] OR $_POST['phone_num'] == $row['phone_num']) {
    	echo "Такой пользователь уже существует";
    } else {
    	// приведение поля e-mail в нижний регистр
    	$email = strtolower($_POST['email']);
    	// запись в БД даных из формы
    	$sql = "INSERT INTO register (name, surname, phone_num, adress_user, denomination, church_name, church_adress, pastor_num, email, password) VALUES ('" . $_POST["name"] . "', '" . $_POST["surname"] . "', '" . $_POST["phone_num"] . "', '" . $_POST["adress_user"] . "', '" . $_POST["denomination"] . "', '" . $_POST["church_name"] . "', '" . $_POST["church_adress"] . "', '" . $_POST["pastor_num"] . "', '" . $email . "', '" . $_POST["password"] . "');";

	  if( mysqli_query($connect, $sql) ) {
	  	// Если все прошло как надо - перенаправление на страницу авторизации
	  	header("location: auth.php");
	  } else {
	    echo "<h2>Произошла ошибка</h2>" . mysqli_error($connect);
	  }
    }
  	

} else {
	echo "Поля не заполнены";
}

?>
</body>
</html>