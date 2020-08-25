<?php
// стирает сохраненны куки
	setcookie("id_user", "", 0, "/");
  	header('location: /');
?>