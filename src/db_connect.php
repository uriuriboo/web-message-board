<?php
try {
    if (getenv('JAWSDB_URL')) {

        $_url = parse_url(getenv('JAWSDB_URL'));
        $dbHost = $_url['host'];
        $dbPort = $_url['port'];
        $dbName = ltrim($_url['path'], '/');
        $dbUser = $_url['user'];
        $dbPass = $_url['pass'];
    }
    else {
        $dbHost = getenv('DB_HOST');
        $dbPort = getenv('BD_PORT');
        $dbName = getenv('BD_NAME');
        $dbUser = getenv('DB_USER');
        $dbPass = getenv('DB_PASS');
    }
    $dsn = "mysql:dbname=$dbName;host=$dbHost:$dbPort";
    $dnh = new PDO($dsn, $dbUser, $dbPass);
}
catch (PDOException $e) {
    echo 'データベース接続失敗';
    echo $e->getMessage();
    exit();
}