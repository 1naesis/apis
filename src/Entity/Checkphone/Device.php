<?php

namespace App\Entity\Checkphone;

use App\Repository\Checkphone\DeviceRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeviceRepository::class)
 */
class Device
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private string $uid;

    /**
     * @ORM\Column(type="smallint", length=25)
     */
    private int $try;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeImmutable $createDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getTry(): int
    {
        return $this->try;
    }

    public function setTry(int $try): self
    {
        $this->try = $try;

        return $this;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getCreateDate(): ?DateTimeImmutable
    {
        return $this->createDate;
    }

    /**
     * @param DateTimeImmutable $createDate
     * @return Device
     */
    public function setCreateDate(DateTimeImmutable $createDate): Device
    {
        $this->createDate = $createDate;
        return $this;
    }
}
