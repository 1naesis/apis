<?php

namespace App\Entity;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var string|null
     *
     * @ORM\Column(name="state", type="string", length=20, nullable=true)
     */
    private $state;

    /**
     * @var string|null
     *
     * @ORM\Column(name="operator", type="string", length=20, nullable=true)
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


}
