<?php


namespace Fox\Core\Portal\Utils;

use \Fox\Entities\Portal;

class Language extends \Fox\Core\Utils\Language
{

    public function setPortal($portal)
    {
        if ($portal->get('language') !== '' && $portal->get('language')) {
            if (!$this->getPreferences()->get('language')) {
                $this->setLanguage($portal->get('language'));
            }
        }
    }

}
