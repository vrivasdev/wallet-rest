<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\Wallet;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ClientService
{
    private $em;

    public function __construct($entityManager)
    {
        $this->em = $entityManager;
    }

    public function client($name, $document, $email, $phone)
    {        
        $client = new Client();

        $client->setName($name);
        $client->setDocument($document);
        $client->setEmail($email);
        $client->setPhone($phone);

        $wallet = new Wallet();

        $wallet->setTotal(0);
        $wallet->setClient($client);

        $this->em->persist($client);
        $this->em->persist($wallet);
        $this->em->flush();
    }

    public function reload($document, $phone, $amount)
    {
        $client = $this->em
                        ->getRepository(Client::class)
                        ->findBy(['document' => $document,
                                  'phone'    => $phone]);

        if ($client) {
            $client[0]->getWallet()->setTotal(200);

            /*$wallet = $this->em->getRepository(Wallet::class)
                               ->findBy(['client_id' => $client[0]->getId()]);

            $wallet->setTotal($amount);*/
            
            $this->em->persist($client[0]);
            $this->em->flush();
        }
        else {
            return "Doesn't exist";
        }

        /*
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());*/ 
    
        //$serializer = new Serializer($normalizers, $encoders);
        
        //return $serializer->serialize($result, 'json');

        //echo($result);

        //return $result;
    }
}