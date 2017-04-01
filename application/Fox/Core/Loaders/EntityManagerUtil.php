<?php


namespace Fox\Core\Loaders;

class EntityManagerUtil extends Base
{
    public function load()
    {
        $entityManager = new \Fox\Core\Utils\EntityManager(
            $this->getcontainer()->make('metadata'),
            $this->getcontainer()->make('language'),
            $this->getcontainer()->make('fileManager')
        );

        return $entityManager;
    }
}

