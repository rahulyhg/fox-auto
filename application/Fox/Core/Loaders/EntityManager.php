<?php


namespace Fox\Core\Loaders;

class EntityManager extends Base
{
    public function load()
    {
        $config = $this->getcontainer()->make('config');

        $params = array(
            'host' => $config->get('database.host'),
            'port' => $config->get('database.port'),
            'dbname' => $config->get('database.dbname'),
            'user' => $config->get('database.user'),
            'password' => $config->get('database.password'),
            'metadata' => $this->getcontainer()->make('metadata')->getOrmMetadata(),
            'repositoryFactoryClassName' => '\\Fox\\Core\\ORM\\RepositoryFactory',
            'driver' => $config->get('database.driver'),
            'platform' => $config->get('database.platform')
        );

        $entityManager = new \Fox\Core\ORM\EntityManager($params);
        $entityManager->setFoxMetadata($this->getcontainer()->make('metadata'));
        $entityManager->setHookManager($this->getcontainer()->make('hookManager'));
        $entityManager->setContainer($this->getContainer());

        return $entityManager;
    }
}

