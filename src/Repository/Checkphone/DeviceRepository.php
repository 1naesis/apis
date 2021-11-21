<?php

namespace App\Repository\Checkphone;

use App\Entity\Checkphone\Device;
use App\Entity\Checkphone\DeviceDTO;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Finder\Exception\AccessDeniedException;

/**
 * @method Device|null find($id, $lockMode = null, $lockVersion = null)
 * @method Device|null findOneBy(array $criteria, array $orderBy = null)
 * @method Device[]    findAll()
 * @method Device[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeviceRepository extends ServiceEntityRepository
{
    private const MAX_COUNT_TRY = 0;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Device::class);
    }

    public function findOneByUid(string $uid): ?Device
    {
        return parent::findOneBy(['uid'=>$uid])??null;
    }

    // TODO: Перенести в UseCase все, что ниже
    public function handler(DeviceDTO $deviceDTO): void
    {
        $deviceDTO->createDate = new DateTimeImmutable();
        $deviceDTO->try = self::MAX_COUNT_TRY;

        $device = $this->findOneByUid($deviceDTO->uid);

        if ($device) {
            $try = $device->getTry();
            if ($try === 0) {
                throw new AccessDeniedException("Forbidden");
            }
            $device ->setTry($try - 1);
        } else {
            $device = (new Device())
                ->setUid($deviceDTO->uid)
                ->setTry($deviceDTO->try)
                ->setCreateDate($deviceDTO->createDate);
        }
        $this->getEntityManager()->persist($device);
        $this->getEntityManager()->flush();
    }
    // /**
    //  * @return Device[] Returns an array of Device objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Device
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
