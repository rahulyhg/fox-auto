<?php


namespace Fox\Services;

use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\NotFound;

use Fox\ORM\Entity;

use \Fox\Core\Htmlizer\Htmlizer;

class Pdf extends \Fox\Core\Services\Base
{

    protected $fontFace = 'freesans';

    protected $fontSize = 12;


    protected function init()
    {
        $this->addDependency('fileManager');
        $this->addDependency('acl');
        $this->addDependency('metadata');
        $this->addDependency('serviceFactory');
        $this->addDependency('dateTime');
        $this->addDependency('number');
    }

    protected function getAcl()
    {
        return $this->getInjection('acl');
    }

    protected function getMetadata()
    {
        return $this->getInjection('metadata');
    }

    protected function getServiceFactory()
    {
        return $this->getInjection('serviceFactory');
    }

    protected function getFileManager()
    {
        return $this->getInjection('fileManager');
    }

    public function buildFromTemplate(Entity $entity, Entity $template, $displayInline = false)
    {
        $entityType = $entity->getEntityType();

        $this->getServiceFactory()->create($entityType)->loadAdditionalFields($entity);

        if ($template->get('entityType') !== $entityType) {
            throw new Forbidden();
        }

        if (!$this->getAcl()->check($entity, 'read') || !$this->getAcl()->check($template, 'read')) {
            throw new Forbidden();
        }

        $htmlizer = new Htmlizer($this->getFileManager(), $this->getInjection('dateTime'), $this->getInjection('number'));

        $pdf = new \Fox\Core\Pdf\Tcpdf();

        $fontFace = $this->getConfig()->get('pdfFontFace', $this->fontFace);

        $pdf->setFont($fontFace, '', $this->fontSize, '', true);
        $pdf->setPrintHeader(false);

        $pdf->setAutoPageBreak(true, $template->get('bottomMargin'));
        $pdf->setMargins($template->get('leftMargin'), $template->get('topMargin'), $template->get('rightMargin'));

        if ($template->get('printFooter')) {
            $htmlFooter = $htmlizer->render($entity, $template->get('footer'));
            $pdf->setFooterPosition($template->get('footerPosition'));
            $pdf->setFooterHtml($htmlFooter);
        } else {
            $pdf->setPrintFooter(false);
        }

        $pdf->addPage();

        $htmlHeader = $htmlizer->render($entity, $template->get('header'));
        $pdf->writeHTML($htmlHeader, true, false, true, false, '');

        $htmlBody = $htmlizer->render($entity, $template->get('body'));
        $pdf->writeHTML($htmlBody, true, false, true, false, '');

        if ($displayInline) {
            $name = $entity->get('name');
            $name = \Fox\Core\Utils\Util::sanitizeFileName($name);
            $fileName = $name . '.pdf';

            $pdf->output($fileName, 'I');
            return;
        }

        return $pdf->output('', 'S');
    }
}

