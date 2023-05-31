<?php
$host = 'localhost';
$db_name = 'pakaDB';
$username = 'root';
$password = '';
$port = "3306";

$options = [
	\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
	\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
	\PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host={$host};dbname={$db_name};port={$port}";

try {
	$db = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
