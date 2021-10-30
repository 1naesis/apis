<?php

namespace App\Repository\Checkphone;

use App\Entity\Checkphone\Client;
use App\Entity\Checkphone\ClientDTO;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function findByPhone(string $phone): ?Client
    {
        return parent::findOneBy(['phone'=>$phone])??null;
    }

    public function findByPhoneJSON(string $phone): array
    {
        $client = parent::findOneBy(['phone'=>$phone]);
        return $client?$client->getArray():array();
    }

    // TODO: Перенести в UseCase все, что ниже
    public function handler(ClientDTO $clientDTO): Client
    {
        $clientDTO->updated = new DateTimeImmutable();
        $clientDTO->state = 'waiting';
        $client = $this->findByPhone($clientDTO->phone);

        if ($client) {
            if ($client->getUpdated() < $clientDTO->updated->modify('-1 month')) {
                $client->setState($clientDTO->state)
                    ->setUpdated($clientDTO->updated);
            }
        } else {
            $client = (new Client())
                ->setPhone($clientDTO->phone)
                ->setState($clientDTO->state)
                ->setUpdated($clientDTO->updated);
        }

        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();

        return $client;
    }

    // /**
    //  * @return Client[] Returns an array of Client objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Client
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
