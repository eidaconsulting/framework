<?php

namespace Core\Caches;

use Core\Entity\Entity;

/**
 * Class Cache
 *
 * @package Core\Caches
 */
class Cache
{
    /**
     * @var string
     */
    private $cacheDir = '../caches';

    /**
     * @var string
     */
    private $cacheExt = '.html';

    /**
     * @var
     */
    private $expirationTime;

    /**
     * @var
     */
    private $cacheDuration;

    /**
     * @var
     */
    private $lifeDuration;

    /**
     * @var
     */
    private $timeUnity;

    /**
     * Cache constructor.
     */
    public function __construct ()
    {
        $entity = new Entity();
        $this->lifeDuration = $entity->app_info('cache_duration');
        $this->timeUnity = $entity->app_info('cache_duration_format');
    }


    /**
     * Get the cache duration from config.php
     *
     * @return float|int|mixed|null
     */
    private function getCacheLife ()
    {

        if ($this->timeUnity == 'm') {
            $times = $this->cacheDuration = $this->lifeDuration * 60;
        } elseif ($this->timeUnity == 'h') {
            $times = $this->cacheDuration = $this->lifeDuration * 3600;
        } else {
            $times = $this->cacheDuration = $this->lifeDuration;
        }

        if($times > 0){
            return time() - $times;
        }

        return 0;

    }

    /**
     * Get file content
     *
     * @param $file
     * @return false|int
     */
    public function readFile ($file)
    {
        $this->expirationTime = $this->getCacheLife();

        var_dump(file_exists($this->cacheDir . '/' . $this->md5Encode($file) . $this->cacheExt), filemtime($this->cacheDir . '/' . $this->md5Encode($file) . $this->cacheExt), $this->expirationTime);

        if (file_exists($this->cacheDir . '/' . $this->md5Encode($file) . $this->cacheExt)
            && filemtime($this->cacheDir . '/' . $this->md5Encode($file) . $this->cacheExt) > $this->expirationTime) {
            return readfile($this->cacheDir . '/' . $this->md5Encode($file) . $this->cacheExt);
        }
        return null;

    }

    /**
     * Create the cache file and save in caches folder root/caches
     *
     * @param $content
     * @param $file
     * @return bool|int
     */
    public function createFile ($content, $file)
    {
        $this->expirationTime = $this->getCacheLife();

        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir . '/', 0777, true);
        }

        if(file_exists($this->cacheDir . '/' . $this->md5Encode($file) . $this->cacheExt)
           && filemtime($this->cacheDir . '/' . $this->md5Encode($file) . $this->cacheExt) > $this->expirationTime){
            return null;
        }
        return file_put_contents($this->cacheDir . '/' . $this->md5Encode($file) . $this->cacheExt, $content);
    }

    /**
     * Delete cache file after the time is finish.
     *
     * @param $file
     */
    public function deleteFile ($file)
    {
        $files = $this->cacheDir . '/' . $this->md5Encode($file) . $this->cacheExt;
        if (file_exists($files)) {
            unlink($files);
        }
    }

    /**
     * Delete all cache files
     */
    public function deleteAllFile ()
    {
        $files = glob($this->cacheDir . '/*');
        foreach ($files as $file) {
            unlink($file);
        }
    }

    /**
     * Recuperation des information qui sont dans le cache
     *
     * @param $content
     * @return mixed
     */
    public function getCache ($content)
    {
        if($this->getCacheLife() > 0){
            $view = $_SERVER['REQUEST_URI'];
            if (!$this->readFile($view)) {
                $this->createFile($content, $view);
                return $content;
            }
        }
        else {
            $this->deleteAllFile();
            return $content;
        }

    }


    /**
     * Generate the cache name
     *
     * @param $value
     * @return string
     */
    private function md5Encode ($value)
    {
        return md5($value);
    }

}