<?php


namespace Fox\EntryPoints;

use \Fox\Core\Exceptions\NotFound;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\BadRequest;

class ChangePassword extends \Fox\Core\EntryPoints\Base
{
    public static $authRequired = false;

    public function handle()
    {
        $requestId = $_GET['id'];
        if (empty($requestId)) {
            throw new BadRequest();
        }

        $config = $this->getConfig();
        $themeManager = $this->getThemeManager();

        $p = $this->getEntityManager()->getRepository('PasswordChangeRequest')->where(array(
            'requestId' => $requestId
        ))->findOne();

        if (!$p) {
            throw new NotFound();
        }

        $runScript = "
            app.getController('PasswordChangeRequest', function (controller) {
                controller.doAction('passwordChange', '{$requestId}');
            });
        ";

        $this->getClientManager()->display($runScript);
    }

    protected function getThemeManager()
    {
        return $this->getcontainer()->make('themeManager');
    }
}

