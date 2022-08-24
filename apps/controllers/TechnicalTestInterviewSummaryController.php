<?php
namespace  apps\controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Exception;

class TechnicalTestInterviewSummaryController 
{
    public function __invoke(Request $request): Response
    {
        return new Response("Hello freightos!");
    }
}