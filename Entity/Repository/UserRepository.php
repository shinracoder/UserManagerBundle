<?php

namespace Cms\UserManagerBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

use Cms\CoreBundle\Repository\CoreRepository;

/**
 * UsersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends CoreRepository
{

    private $usersTable = 'UserManagerBundle:User';
    public $language;
    public $languageId = 1;

    public function getUserByUsername($username , $returnType = 'OBJECT'){

        if (!$username){ return false; }

        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('u')
            ->from($this->usersTable, 'u')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->setMaxResults(1);

        if ($returnType == 'ARRAY') {
            $results = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);
        }else{
            $results = $qb->getQuery()->getResult();
        }

        return $results;

    }

}