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
    private $cacheDir = '../cacheFile';
    /**
     * @var string
     */
    private $cacheExt = '.html';
    /**
     * @var
     */
    private $cacheExp;
    /**
     * @var
     */
    private $cacheDuration;

    /**
     * Cache constructor.
     */
    public function __construct() {
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir.'/', 0777, true);
        }
        return $this->cacheDir;
    }

    /**
     * Get the cache duration from config.php
     * @return float|int|mixed|null
     */
    private function getCacheLife(){
        $entity = new Entity();
        $duration = $entity->app_info('cache_duration');
        $type = $entity->app_info('cache_duration_format');

        if($type == 'm'){
            $times = $this->cacheDuration = $duration * 60;
        }
        elseif ($type == 'h'){
            $times = $this->cacheDuration = $duration * 3600;
        }
        else {
            $times = $this->cacheDuration = $duration;
        }

        return time()-$times;

    }

    /**
     * Generate the cache name
     * @param $value
     * @return string
     */
    private function md5Encode($value){
        return md5($value);
    }

    /**
     * Get file content
     * @param $file
     * @return false|int
     */
    public function readFile($file) {

        $this->cacheExp = $this->getCacheLife();

        if(file_exists($this->cacheDir.'/'.$this->md5Encode($file).$this->cacheExt)
            && filemtime($this->cacheDir.'/'.$this->md5Encode($file).$this->cacheExt) > $this->cacheExp)
        {
            return readfile($this->cacheDir.'/'.$this->md5Encode($file).$this->cacheExt);
        }

    }

    /**
     * Create the cache file and save in caches folder root/caches
     * @param $content
     * @param $file
     * @return bool|int
     */
    public function createFile($content, $file){
        return file_put_contents($this->cacheDir.'/'.$this->md5Encode($file).$this->cacheExt, $content);
    }

    /**
     * Delete cache file after the time is finish.
     * @param $file
     */
    public function deleteFile($file){
        $files = $this->cacheDir.'/'.$this->md5Encode($file).$this->cacheExt;
        if(file_exists($files))
        {
            unlink($files);
        }
    }

    /**
     * Delete all cache files
     */
    public function deleteAllFile(){
        $files = glob($this->cacheDir.'/*');
        foreach ($files as $file){
            unlink($file);
        }
    }


    /**
     * Recuperation des information qui sont dans le cache
     * @param $content
     * @return mixed
     */
    public function getCache($content){
        $view = $_SERVER['REQUEST_URI'];
        if(!$this->readFile($view)){
            $this->createFile($content, $view);
            return $content;
        }
    }

}