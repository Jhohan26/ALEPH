<form class="busqueda" method="GET" action="./catalogo.php">
	<input type="text" name="busqueda" placeholder="¿Que deseas aprender?" autocomplete="off" value="<?php echo($_GET["busqueda"]); ?>">
	<button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>