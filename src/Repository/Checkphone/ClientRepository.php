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

        if ($client != null && $client->getUpdated() < $clientDTO->updated->modify('-1 month')) {
            $client->setState($clientDTO->state)
                ->setUpdated($clientDTO->updated);
        } else if ($client == null) {
            $client = (new Client())
                ->setPhone($clientDTO->phone)
                ->setState($clientDTO->state)
                ->setUpdated($clientDTO->updated);
        }

        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();

        return $client;
    }

    public function countToDay($begin_date = null, $end_date = null) {

        $begin_date = new DateTimeImmutable('2.11.2021');

        $begin_date = $begin_date ?? (new DateTimeImmutable())->setTime(0, 0);
        $end_date = $end_date ?? (new DateTimeImmutable())->setTime(0, 0)->modify("+1 day");

        if ($begin_date > $end_date) {
            $tmp_day = $begin_date;
            $begin_date = $end_date;
            $end_date = $tmp_day;
        }

        return $this->createQueryBuilder('c')
            ->where('c.updated >= :date_start AND c.updated < :date_stop')
            ->setParameter('date_start', $begin_date)
            ->setParameter('date_stop', $end_date)
            ->getQuery()
            ->getResult();
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
