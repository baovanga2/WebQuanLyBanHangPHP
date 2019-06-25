<?php
class DatabaseConnection
{
    private $databaseInfo = [
        [
            'db_host'   => 'localhost',
            'db_name'   => 'webquanlybanhang',
            'db_user'   => 'root',
            'db_passwd' => ''
        ]
    ];

    public function __construct($hostName, $databaseName, $userName, $userPasswd)
    { 
        foreach ($$databaseInfo as $key ) {
            $this->$key['db_host'] = $hostName;
            $this->$key['db_name'] = $databaseName;
            $this->$key['db_user'] = $userName;
            $this->$key['db_passwd'] = $userPasswd;
        }
    }

    public function connectDatabase()
    {
        # code...
        print_r("<pre>");
        print_r(var_dump($database));
    }
}
?>