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
        $mbd = $this->connection->connection();
        foreach($mbd->query('SELECT * from users') as $fila) {
            var_dump($fila);
        }

        die;

        return new Response("Hello world!");

    }
}