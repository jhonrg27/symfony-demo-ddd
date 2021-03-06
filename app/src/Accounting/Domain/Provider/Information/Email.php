<?php

namespace Misa\Accounting\Domain\Provider\Information;

use Misa\Accounting\Domain\Provider\Provider;
use MisaSdk\Common\Entity\AbstractEntity;

/**
 * Email Class
 *
 * @package Misa\Accounting\Domain\Provider\Information
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2017, Orbis
 */
class Email extends AbstractEntity
{
    /** @var string */
    private $id;

    /** @var string */
    private $email;

    /** @var Provider */
    private $provider;

    /**
     * @param Provider $provider
     * @param $email
     * @param string $id
     * @return Email
     */
    public static function create(Provider $provider, $email, $id = self::EMPTY_ID)
    {
        $emailObj = new self();
        $emailObj->id = self::uuid($id)->getId();
        $emailObj->email = $email;
        $emailObj->provider = $provider;
        return $emailObj;
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function changeEmail($email)
    {
        $this->email = $email;
    }
}
