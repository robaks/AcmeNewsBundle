<?php

namespace AcmeNewsBundle\Repositories;

use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{

    /**
     * @param integer $page
     * @return array
     */
    public function getListByPage($page = 1)
    {
        $query = $this->createQueryBuilder('n')
            ->where('n.published = true')
            ->setFirstResult(($page-1)*5)
            ->setMaxResults(5)
            ->getQuery();

        return $query->getResult();
    }
}