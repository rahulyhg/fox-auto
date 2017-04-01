<?php
namespace Fox\Core;

class DataManager
{
    private $container;

    private $cachePath = 'data/cache';


    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Rebuild the system with metadata, database and cache clearing
     *
     * @return bool
     */
    public function rebuild($entityList = null)
    {
        $result = $this->clearCache();

        $result &= $this->rebuildMetadata();

        $result &= $this->rebuildDatabase($entityList);

        return $result;
    }

    /**
     * Clear a cache
     *
     * @return bool
     */
    public function clearCache()
    {
        $result = $this->container->make('fileManager')->removeInDir($this->cachePath);

        if ($result != true) {
            throw new Exceptions\Error("Error while clearing cache");
        }

        $this->updateCacheTimestamp();

        return $result;
    }

    /**
     * Rebuild database
     *
     * @return bool
     */
    public function rebuildDatabase($entityList = null)
    {
        try {
            $result = $this->container->make('schema')->rebuild($entityList);
        } catch (\Exception $e) {
            $result = false;
            logger()->error('Fault to rebuild database schema'.'. Details: '.$e->getMessage());
        }

        if ($result != true) {
            throw new Exceptions\Error("Error while rebuilding database. See log file for details.");
        }

        $this->updateCacheTimestamp();

        return $result;
    }

    /**
     * Rebuild metadata
     *
     * @return bool
     */
    public function rebuildMetadata()
    {
        $metadata = $this->container->make('metadata');

        $metadata->init(true);

        $ormMeta = $metadata->getOrmMetadata(true);

        $this->updateCacheTimestamp();

        return empty($ormMeta) ? false : true;
    }

    /**
     * Update cache timestamp
     *
     * @return bool
     */
    public function updateCacheTimestamp()
    {
        $c = $this->container->make('config');
        $c->updateCacheTimestamp();
        $c->save();
        return true;
    }
}
