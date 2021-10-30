<?php

namespace App\Entity\Checkphone;

use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="client_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=false)
     */
    private $phone;

    /**
     * @var DateTimeImmutable|null
     *
     * @ORM\Column(name="updated", type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $updated;

    /**
     * @var string|null
     *
     * @ORM\Column(name="state", type="string", length=20, nullable=true)
     */
    private $state;

    /**
     * @var string|null
     *
     * @ORM\Column(name="operator", type="string", length=64, nullable=true)
     */
    private $operator;

    /**
     * @var string|null
     *
     * @ORM\Column(name="region", type="string", length=64, nullable=true)
     */
    private $region;

    /**
     * @var string|null
     *
     * @ORM\Column(name="names", type="string", length=255, nullable=true)
     */
    private $names;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vk", type="string", length=128, nullable=true)
     */
    private $vk;

    /**
     * @var string|null
     *
     * @ORM\Column(name="insta", type="string", length=128, nullable=true)
     */
    private $insta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fb", type="string", length=128, nullable=true)
     */
    private $fb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="day_birdth", type="string", length=16, nullable=true)
     */
    private $dayBirdth;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tg", type="string", length=128, nullable=true)
     */
    private $tg;

    /**
     * @var string|null
     *
     * @ORM\Column(name="whatsapp", type="string", length=128, nullable=true)
     */
    private $whatsapp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="viber", type="string", length=128, nullable=true)
     */
    private $viber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ok", type="string", length=128, nullable=true)
     */
    private $ok;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adress", type="string", length=700, nullable=true)
     */
    private $adress;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Client
     */
    public function setId(int $id): Client
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Client
     */
    public function setPhone(string $phone): Client
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getUpdated(): ?DateTime
    {
        return $this->updated;
    }

    /**
     * @param DateTimeImmutable $updated
     * @return Client
     */
    public function setUpdated(DateTimeImmutable $updated): Client
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     * @return Client
     */
    public function setState(?string $state): Client
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOperator(): ?string
    {
        return $this->operator;
    }

    /**
     * @param string|null $operator
     * @return Client
     */
    public function setOperator(?string $operator): Client
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string|null $region
     * @return Client
     */
    public function setRegion(?string $region): Client
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNames(): ?string
    {
        return $this->names;
    }

    /**
     * @param string|null $names
     * @return Client
     */
    public function setNames(?string $names): Client
    {
        $this->names = $names;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVk(): ?string
    {
        return $this->vk;
    }

    /**
     * @param string|null $vk
     * @return Client
     */
    public function setVk(?string $vk): Client
    {
        $this->vk = $vk;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInsta(): ?string
    {
        return $this->insta;
    }

    /**
     * @param string|null $insta
     * @return Client
     */
    public function setInsta(?string $insta): Client
    {
        $this->insta = $insta;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFb(): ?string
    {
        return $this->fb;
    }

    /**
     * @param string|null $fb
     * @return Client
     */
    public function setFb(?string $fb): Client
    {
        $this->fb = $fb;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Client
     */
    public function setEmail(?string $email): Client
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDayBirdth(): ?string
    {
        return $this->dayBirdth;
    }

    /**
     * @param string|null $dayBirdth
     * @return Client
     */
    public function setDayBirdth(?string $dayBirdth): Client
    {
        $this->dayBirdth = $dayBirdth;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTg(): ?string
    {
        return $this->tg;
    }

    /**
     * @param string|null $tg
     * @return Client
     */
    public function setTg(?string $tg): Client
    {
        $this->tg = $tg;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWhatsapp(): ?string
    {
        return $this->whatsapp;
    }

    /**
     * @param string|null $whatsapp
     * @return Client
     */
    public function setWhatsapp(?string $whatsapp): Client
    {
        $this->whatsapp = $whatsapp;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getViber(): ?string
    {
        return $this->viber;
    }

    /**
     * @param string|null $viber
     * @return Client
     */
    public function setViber(?string $viber): Client
    {
        $this->viber = $viber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOk(): ?string
    {
        return $this->ok;
    }

    /**
     * @param string|null $ok
     * @return Client
     */
    public function setOk(?string $ok): Client
    {
        $this->ok = $ok;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdress(): ?string
    {
        return $this->adress;
    }

    /**
     * @param string|null $adress
     * @return Client
     */
    public function setAdress(?string $adress): Client
    {
        $this->adress = $adress;
        return $this;
    }

    public function getArray(): array
    {
        return array(
            "id" => $this->getId(),
            "phone" => $this->getPhone(),
            "updated" => $this->getUpdated(),
            "state" => $this->getState(),
            "operator" => $this->getOperator(),
            "region" => $this->getRegion(),
            "names" => $this->getNames(),
            "vk" => $this->getVk(),
            "insta" => $this->getInsta(),
            "fb" => $this->getFb(),
            "email" => $this->getEmail(),
            "dayBirdth" => $this->getDayBirdth(),
            "tg" => $this->getTg(),
            "whatsapp" => $this->getWhatsapp(),
            "viber" => $this->getViber(),
            "ok" => $this->getOk(),
            "adress" => $this->getAdress()
        );
    }

}
