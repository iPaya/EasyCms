<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Widgets\TreeView;


use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class TreeView extends Widget
{
    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - labelOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    public $items = [];
    /**
     * @var boolean whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = true;
    public $options = [];
    public $labelOptions = [
        'class' => 'folder'
    ];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        Html::addCssClass($this->options, 'filetree');
    }

    /**
     * @return string|void
     * @throws InvalidConfigException
     */
    public function run()
    {
        echo $this->renderItems($this->items, false);
        TreeViewAsset::register($this->getView());
        $this->getView()->registerJs("$(\"#{$this->options['id']}\").treeview();");
    }

    /**
     * @param array $items
     * @param bool $isChildItems
     * @return string
     * @throws InvalidConfigException
     */
    public function renderItems(array $items, bool $isChildItems = false)
    {
        if ($isChildItems && count($items) == 0) {
            return null;
        }
        $itemsHtml = [];
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            $itemsHtml[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $itemsHtml), $isChildItems ? [] : $this->options);
    }

    /**
     * Renders a widget's item.
     * @param  string|array $item the item to render.
     * @return string                 the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $label = $this->encodeLabels ? Html::encode($item['label']) : $item['label'];
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $labelOptions = ArrayHelper::merge($this->labelOptions, ArrayHelper::getValue($item, 'labelOptions', []));
        $links = ArrayHelper::getValue($item, 'links', []);

        $linksHtml = [];
        foreach ($links as $link) {
            if (is_array($link)) {
                $linkUrl = ArrayHelper::getValue($link, 'url');
                $linkLabel = ArrayHelper::getValue($link, 'label');
                $linkOptions = ArrayHelper::getValue($link, 'options', []);
                $linksHtml[] = Html::a($linkLabel, $linkUrl, $linkOptions);
            } elseif (is_string($link)) {
                $linksHtml[] = $link;
            }

        }

        $itemsHtml = '';
        if ($items !== null) {
            if (is_array($items)) {
                $itemsHtml = $this->renderItems($items, true);
            }
        }

        return Html::tag('li', Html::tag('span', $label, $labelOptions) . implode(' ', $linksHtml) . $itemsHtml, $options);
    }

}
