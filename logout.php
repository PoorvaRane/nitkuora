<!DOCTYPE html>
<html>
    <body>

    	<?php
			session_start();

			if(isset($_GET['logout']))
			{
				session_destroy();
				unset($_SESSION['user']);
				header("Location: login.html");
			}
		?>

    </body>
</html>