<?php

namespace src\Share\Domain;

interface MysqlConnection
{
    public function connection();
    public function close();
}