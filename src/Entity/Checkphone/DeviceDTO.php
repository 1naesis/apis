<?php


namespace App\Entity\Checkphone;


use DateTimeImmutable;

class DeviceDTO
{
    public int $id;
    public string $uid;
    public int $try;
    public DateTimeImmutable $createDate;
}