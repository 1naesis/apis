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
    private ImagesRepository $imagesRepository;

    public function __construct(ManagerRegistry $registry, ImagesRepository $imagesRepository)
    {
        $this->imagesRepository = $imagesRepository;
        parent::__construct($registry, Client::class);
    }

    public function findByPhone(string $phone): ?Client
    {
        $client = parent::findOneBy(['phone'=>$phone])??null;

        if ($client != null) {
            $client->setImages($this->imagesRepository->findByClientId($client->getId()));
        }

        return $client;
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
        $client->setLastQuery($clientDTO->updated);

        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();

        return $client;
    }

    public function countToDay($begin_date = null, $end_date = null): array
    {

        $begin_date = (new DateTimeImmutable($begin_date))->setTime(0, 0)
            ?? (new DateTimeImmutable())->setTime(0, 0);
        $end_date = (new DateTimeImmutable($end_date))->setTime(0, 0)->modify("+1 day")
            ?? (new DateTimeImmutable())->setTime(0, 0)->modify("+1 day");

        if ($begin_date > $end_date) {
            $tmp_day = $begin_date;
            $begin_date = $end_date;
            $end_date = $tmp_day;
        }

        return $this->createQueryBuilder('c')
            ->where('c.lastQuery >= :date_start AND c.lastQuery <= :date_stop')
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
