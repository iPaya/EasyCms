<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App;

/**
 * Class Module
 * @package App
 * @property array $menu
 */
abstract class Module extends \yii\base\Module
{
    /**
     * @var array
     */
    private $_menu = [];
    /**
     * @var array
     */
    private $_nav = [];
    /**
     * @var string
     */
    private $_title;
    /**
     * @var string|array
     */
    private $_homeUrl;

    /**
     * @return array
     */
    public function getMenu(): array
    {
        return $this->_menu;
    }

    /**
     * @param array $menu
     */
    public function setMenu(array $menu)
    {
        $this->_menu = $menu;
    }

    /**
     * @return array
     */
    public function getNav(): array
    {
        return $this->_nav;
    }

    /**
     * @param array $nav
     */
    public function setNav(array $nav)
    {
        $this->_nav = $nav;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->_title = $title;
    }

    /**
     * @return array|string
     */
    public function getHomeUrl()
    {
        return $this->_homeUrl;
    }

    /**
     * @param array|string $homeUrl
     */
    public function setHomeUrl($homeUrl): void
    {
        $this->_homeUrl = $homeUrl;
    }
}
