<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="<?=$meta['description']?>">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$meta['title']?></title>
</head>
<body>

<h1>Hello this is the default layout</h1>
<?=$content?>

<?php
$logs = \R::getDatabaseAdapter()->getDatabase()->getLogger();

debug($logs->grep( 'SELECT' ));
?>
</body>
</html>