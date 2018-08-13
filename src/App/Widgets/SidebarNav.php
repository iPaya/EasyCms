<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Widgets;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

class SidebarNav extends Menu
{
    public $options = [
        'class' => 'nav flex-column'
    ];
    public $itemOptions = [
        'class' => 'nav-item',
    ];
    public $submenuOptions = [
        'class' => 'nav flex-column pl-4'
    ];
    public $linkOptions = [
        'class' => 'nav-link',
    ];

    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            Html::addCssClass($options, $class);

            $linkOptions = $this->linkOptions;
            if (!empty($item['items'])) {
                $submenuOptions = $this->submenuOptions;
                $id = $this->getId() . '-submenu-' . $i;
                $submenuOptions['id'] = $submenuOptions['id'] ?? $id;

                if ($item['active']) {
                    Html::addCssClass($submenuOptions, 'show');
                } else {
                    Html::addCssClass($submenuOptions, 'hide');
                }

                $submenuTemplate = Html::tag('ul', '{items}', $submenuOptions);
                $submenu = strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            } else {
                $submenu = '';
            }

            $menu = $this->renderItem($item, $linkOptions);
            $menu .= $submenu;
            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }

    /**
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
     * @return string the rendering result
     */
    protected function renderItem($item, $options = [])
    {
        if (isset($item['url'])) {
            return Html::a($item['label'], Url::to($item['url']), $options);
        } else {
            return Html::a($item['label'], 'javascript:;', $options);
        }
    }

}
