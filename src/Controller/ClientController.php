<?php

namespace App\Controller;

use App\Service\ClientService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    /**
     * @Route("/soap")
     */
    public function index(ClientService $clientService)
    {
        $options = [
            'uri'        => 'http://127.0.0.1:8000/index.php/soap?wsdl',
            'cache_wsdl' => WSDL_CACHE_NONE, 
            'exceptions' => true
        ];
        
        $soapServer = new \SoapServer(dirname(__FILE__) . './client.wsdl', $options);
        $soapServer->setObject($clientService);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }
}