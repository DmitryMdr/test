<?php
// страница авторизации
include "../configs/db.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Авторизация</title>
</head>

<body>
<!-- форма для отправки -->
	<form action="auth.php" method="post">
		<p>
		<input type="email" name="email" placeholder="email">
		</p>
		<p>
		<input type="password" name="password" placeholder="password">
		</p>
		<button type="submit">auth</button>
	</form>
<!-- ссылка на страницу регистрации -->
<a href="registr.php">registr</a>
	<?php
	// прверка на существование и не пустоту запросов
	if (isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] != "" && $_POST["password"] != "") {
		// приведение поля e-mail в нижний регистр
		$email = strtolower($_POST['email']);
		// Сравниваем пароль и емаил
		$sql = "SELECT * FROM register WHERE email LIKE '" . $email . "' AND password LIKE '" . $_POST['password'] . "' ";
    	$result = mysqli_query($connect, $sql);
    	$col_user = mysqli_num_rows($result);
    		// если количество пользователей равно 1, то 
	    	if( $col_user == 1 ) {
	    		// Создаем куку,которая хранит ID пользователя и перенаправляем на главную страницу.
	    		$user = mysqli_fetch_assoc($result);
		  		setcookie("id_user", $user['id'], time() + 60*60, "/");
				header("location: ../index.php");
				
		  	} else {
	    	echo "<h2>Такого пользователя не существует!</h2>";
	  		}
	} 
?>
</body>
</html>