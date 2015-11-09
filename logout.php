<!DOCTYPE html>
<html>
    <body>

    	<?php
			session_start();

			if(isset($_GET['logout']))
			{
				session_unset();
				session_destroy();
				header("Location: login.html");
			}
		?>

    </body>
</html>