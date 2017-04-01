<?php


namespace Fox\Services;

class Team extends Record
{
    protected function init()
    {
        $this->addDependency('fileManager');
    }

    protected $linkSelectParams = array(
        'users' => array(
            'additionalColumns' => array(
                'role' => 'teamRole'
            )
        )
    );

    protected function getFileManager()
    {
        return $this->getInjection('fileManager');
    }

    public function afterUpdate(Entity $entity, array $data)
    {
        parent::afterUpdate($entity, $data);
        if (array_key_exists('rolesIds', $data)) {
            $this->clearRolesCache();
        }
    }

    protected function clearRolesCache($id)
    {
        $this->getFileManager()->removeInDir('data/cache/application/acl');
    }

    public function linkEntity($id, $link, $foreignId)
    {
        $result = parent::linkEntity($id, $link, $foreignId);

        if ($link === 'users') {
            $this->getFileManager()->removeFile('data/cache/application/acl/' . $foreignId . '.php');
        }

        return $result;
    }

    public function unlinkEntity($id, $link, $foreignId)
    {
        $result = parent::unlinkEntity($id, $link, $foreignId);

        if ($link === 'users') {
            $this->getFileManager()->removeFile('data/cache/application/acl/' . $foreignId . '.php');
        }

        return $result;
    }

    public function linkEntityMass($id, $link, $where)
    {
        $result = parent::linkEntityMass($id, $link, $where);

        if ($link === 'users') {
            $this->getFileManager()->removeInDir('data/cache/application/acl');
        }

        return $result;
    }
}

