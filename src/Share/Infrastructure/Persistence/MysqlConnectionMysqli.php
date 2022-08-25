<?php

namespace src\Share\Infrastructure\Persistence;


use src\Share\Domain\MysqlConnection;

class MysqlConnectionMysqli implements MysqlConnection
{
    private $connection;
    private string $host;
    private string $user;
    private string $password;

    public function __construct(string $db_host, string $db_user, string $db_password)
    {
        $this->host = $db_host;
        $this->user = $db_user;
        $this->password = $db_password;

        $this->connect($this->host,$this->user,$this->password);
    }


    private function connect(string $host, string $user,string $password)
    {
        if ($this->connection === null) {
            $this->run_register_shutdown_function();
            $this->connection  = new \PDO('mysql:host='.$host.';dbname=technical-test', $user, $password);
        }
    }

    public function connection()
    {
        return $this->connection;
    }


    public function close()
    {
        if ($this->connection) {
            $this->connection = null;
        }
    }

    public function run_register_shutdown_function()
    {
        register_shutdown_function(
            function () {
                session_write_close();
                $this->close();
            }
        );
    }

}