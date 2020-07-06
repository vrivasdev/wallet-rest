<?php

namespace App\Service;

use App\Entity\Client;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validation;

class ClientService
{
    private $em;

    public function __construct($entityManager)
    {
        $this->em = $entityManager;
    }

    public function client($name, $document, $email, $phone)
    {
        $validator = Validation::createValidator();
        
        $client = new Client();

        $client->setName($name);
        $client->setDocument($document);
        $client->setEmail($email);
        $client->setPhone($phone);

        $this->em->persist($client);
        $this->em->flush();
    }
}