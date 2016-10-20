<?php

namespace AcmeNewsBundle\Services;

use AcmeNewsBundle\Repositories\NewsRepository;

class NewsService
{
    private $repository;

    /**
     * @param NewsRepository $repository
     */
    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $page
     * @return array
     */
    public function getListByPage($page = 1)
    {
        return $this->repository->getListByPage($page);
    }

    /**
     * @return array
     */
    public function getHot()
    {
        return $this->repository->findBy(
            ['published' => true],
            ['createdAt' => 'DESC'],
            3,
            0
        );
    }
}