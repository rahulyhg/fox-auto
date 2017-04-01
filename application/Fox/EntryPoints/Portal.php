<?php


namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class Portal extends \Fox\Core\EntryPoints\Base
{
    public static $authRequired = false;

    public function handle($data = array())
    {
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        } else if (!empty($data['id'])) {
            $id = $data['id'];
        } else {
            $id = $this->getConfig()->get('defaultPortalId');
            if (!$id) {
                throw new NotFound();
            }
        }

        $application = new \Fox\Core\Portal\Application($id);
        $application->setBasePath($this->getcontainer()->make('clientManager')->getBasePath());
        $application->runClient();
    }
}
