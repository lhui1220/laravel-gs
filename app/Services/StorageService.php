<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/11
 * Time: 15:01
 */

namespace App\Services;

use Illuminate\Support\Facades\Log;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\Handler;
use League\Flysystem\PluginInterface;
use OSS\Core\OssException;
use OSS\OssClient;

/**
 * Class StorageService
 * @package App\Services
 *
 * 阿里云存储服务
 * v1:实现Get/Put操作
 */
class StorageService implements FilesystemInterface
{
    private $config;
    private $ossClient;

    public function __construct($config)
    {
        $this->config = $config;
        $this->ossClient = new OssClient($config['accesskey_id'],$config['accesskey_secret'],$config['endpoint']);
    }

    /**
     * @inheritDoc
     */
    public function has($path)
    {
        // TODO: Implement has() method.
    }

    /**
     * @inheritDoc
     */
    public function read($path)
    {
        try {
            return $this->ossClient->getObject($this->config['bucket'],$path);
        }catch (OssException $e) {
            Log::error("read file error,msg:{$e->getMessage()}");
        }

    }

    /**
     * @inheritDoc
     */
    public function readStream($path)
    {
        // TODO: Implement readStream() method.
    }

    /**
     * @inheritDoc
     */
    public function listContents($directory = '', $recursive = false)
    {
        // TODO: Implement listContents() method.
    }

    /**
     * @inheritDoc
     */
    public function getMetadata($path)
    {
        // TODO: Implement getMetadata() method.
    }

    /**
     * @inheritDoc
     */
    public function getSize($path)
    {
        // TODO: Implement getSize() method.
    }

    /**
     * @inheritDoc
     */
    public function getMimetype($path)
    {
        // TODO: Implement getMimetype() method.
    }

    /**
     * @inheritDoc
     */
    public function getTimestamp($path)
    {
        // TODO: Implement getTimestamp() method.
    }

    /**
     * @inheritDoc
     */
    public function getVisibility($path)
    {
        // TODO: Implement getVisibility() method.
    }

    /**
     * @inheritDoc
     */
    public function write($path, $contents, array $config = [])
    {

    }

    /**
     * @inheritDoc
     */
    public function writeStream($path, $resource, array $config = [])
    {
        // TODO: Implement writeStream() method.
    }

    /**
     * @inheritDoc
     */
    public function update($path, $contents, array $config = [])
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function updateStream($path, $resource, array $config = [])
    {
        // TODO: Implement updateStream() method.
    }

    /**
     * @inheritDoc
     */
    public function rename($path, $newpath)
    {
        // TODO: Implement rename() method.
    }

    /**
     * @inheritDoc
     */
    public function copy($path, $newpath)
    {
        // TODO: Implement copy() method.
    }

    /**
     * @inheritDoc
     */
    public function delete($path)
    {
        try {
            $res = $this->ossClient->deleteObject($this->config['bucket'],$path);
            Log::debug("del result:".json_encode($res));
            return true;
        }catch (OssException $e) {
            Log::error("put file error.msg:{$e->getMessage()}");
            return false;
        }

    }

    /**
     * @inheritDoc
     */
    public function deleteDir($dirname)
    {
        // TODO: Implement deleteDir() method.
    }

    /**
     * @inheritDoc
     */
    public function createDir($dirname, array $config = [])
    {
        // TODO: Implement createDir() method.
    }

    /**
     * @inheritDoc
     */
    public function setVisibility($path, $visibility)
    {
        // TODO: Implement setVisibility() method.
    }

    /**
     * @inheritDoc
     */
    public function put($path, $contents, array $config = [])
    {
        try {
            $this->ossClient->putObject($this->config['bucket'],$path,$contents);
            return true;
        }catch (OssException $e) {
            Log::error("put file error.msg:{$e->getMessage()}");
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function putStream($path, $resource, array $config = [])
    {
        // TODO: Implement putStream() method.
    }

    /**
     * @inheritDoc
     */
    public function readAndDelete($path)
    {
        // TODO: Implement readAndDelete() method.
    }

    /**
     * @inheritDoc
     */
    public function get($path, Handler $handler = null)
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function addPlugin(PluginInterface $plugin)
    {
        // TODO: Implement addPlugin() method.
    }

}