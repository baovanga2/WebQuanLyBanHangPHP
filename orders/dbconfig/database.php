<?php
global $conn;
$databaseInfo = [
  [
    'db_host'   => 'localhost',
    'db_name'   => 'webquanlybanhang',
    'db_user'   => 'root',
    'db_passwd' => ''
  ]
];

function connect_db()
{
  global $conn;
  if (!$conn) {
    $conn = mysqli_connect('localhost', 'root', '', 'webquanlybanhang') or die('Can not connect to database');
    mysqli_set_charset($conn, 'utf8');
  }
}

function disconnect_db()
{
  global $conn;
  if ($conn) {
    mysqli_close($conn);
  }
}
