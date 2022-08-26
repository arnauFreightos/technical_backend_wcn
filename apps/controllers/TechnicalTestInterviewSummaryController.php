<?php
namespace  apps\controllers;

use src\Share\Infrastructure\Persistence\MysqlConnectionMysqli;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TechnicalTestInterviewSummaryController extends AbstractController
{
    private $connection;

    public function __construct(MysqlConnectionMysqli $connection)
    {
        $this->connection = $connection;
    }

    public function __invoke(Request $request): Response
    {
        //PDO $connection example. Before test SQL create table "users" with fields -> ID (int autoincrement), email (varchar 255)
//        $mbd = $this->connection->connection();
//        foreach($mbd->query('SELECT * from users') as $row) {
//            print_r($row);
//        }


        return new Response("Hello world!");

    }
}