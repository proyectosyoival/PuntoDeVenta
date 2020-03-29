<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <?php require 'views/menu.php'; ?>
    <div class="" id="content-">
    	<div class="">
    		<h1>Bienvenido <?php echo $_SESSION['nombre']; ?></h1>
    	</div>
    </div>
    <?php require 'views/footer.php'; ?> 

</body>
</html>