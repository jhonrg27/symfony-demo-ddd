<?php

namespace Misa\Users\Domain;

use Misa\Common\Adapter\Persistence\Doctrine\MisaRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
interface UserRepository extends MisaRepository
{
    /**
     * @param array $filter
     * @return array
     */
    public function listAll($filter);

    /**
     * @param User $user
     * @return bool
     */
    public function persist(User $user);

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user);
}
