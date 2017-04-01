<?php


namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class Pdf extends \Fox\Core\EntryPoints\Base
{
    public static $authRequired = true;

    public function handle()
    {

        if (empty($_GET['entityId']) || empty($_GET['entityType']) || empty($_GET['templateId'])) {
            throw new BadRequest();
        }
        $entityId = $_GET['entityId'];
        $entityType = $_GET['entityType'];
        $templateId = $_GET['templateId'];

        $entity = $this->getEntityManager()->getEntity($entityType, $entityId);
        $template = $this->getEntityManager()->getEntity('Template', $templateId);

        if (!$entity || !$template) {
            throw new NotFound();
        }

        $this->getcontainer()->make('serviceFactory')->create('Pdf')->buildFromTemplate($entity, $template, true);

        exit;
    }
}

