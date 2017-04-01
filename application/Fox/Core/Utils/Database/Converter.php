<?php
namespace Fox\Core\Utils\Database;

use Fox\Core\Utils\Util,
    Fox\ORM\Entity;

class Converter
{
    private $metadata;

    private $fileManager;

    private $schemaConverter;

    private $schemaFromMetadata = null;

    public function __construct(\Fox\Core\Utils\Metadata $metadata, \Fox\Core\Utils\File\Manager $fileManager)
    {
        $this->metadata = $metadata;
        $this->fileManager = $fileManager;

        $this->ormConverter = new Orm\Converter($this->metadata, $this->fileManager, $metadata->getMetadataHelper());

        $this->schemaConverter = new Schema\Converter($this->fileManager);
    }

    public function getSchemaFromMetadata($entityList = null)
    {
        $ormMeta = $this->metadata->getOrmMetadata();

        $this->schemaFromMetadata = $this->schemaConverter->process($ormMeta, $entityList);

        return $this->schemaFromMetadata;
    }

    /**
    * Main method of convertation from metadata to orm metadata and database schema
    *
    * @return bool
    */
    public function process()
    {
        logger()->debug('Orm\Converter - Start: orm convertation');

        $ormMeta = $this->ormConverter->process();

        //save database meta to a file espoMetadata.php
        $result = $this->metadata->setOrmMetadata($ormMeta);

        logger()->debug('Orm\Converter - End: orm convertation, result=['.$result.']');

        return $result;
    }
}
