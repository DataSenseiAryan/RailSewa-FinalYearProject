<html>
<head>
	<title>Shell</title>
</head>
<body>
<?php
$output = shell_exec('./usr/local/spark/start-all.sh');
echo "<pre>$output</pre>";
?>
</body>
</html>

