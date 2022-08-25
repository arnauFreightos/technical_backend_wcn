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
        //$connection example
//        $mbd = $this->connection->connection();
//        foreach($mbd->query('SELECT * from users') as $row) {
//            var_dump($row);
//        }


        return new Response("Hello world!");

    }
}