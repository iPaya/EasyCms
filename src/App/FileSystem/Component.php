<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\FileSystem;


use League\Flysystem\AdapterInterface;
use yii\base\InvalidConfigException;
use yii\di\Instance;

class Component extends \yii\base\Component
{
    /**
     * @var AdapterInterface
     */
    public $adapter;

    /**
     * @var \League\Flysystem\Filesystem
     */
    private $_fileSystem;

    public function init()
    {
        parent::init();

        if ($this->adapter == null) {
            throw new InvalidConfigException('请配置 "adapter".');
        }

        $this->adapter = Instance::ensure($this->adapter, AdapterInterface::class);
        $this->_fileSystem = new \League\Flysystem\Filesystem($this->adapter);
    }

    /**
     * @return \League\Flysystem\Filesystem
     */
    public function getFileSystem()
    {
        return $this->_fileSystem;
    }

}
