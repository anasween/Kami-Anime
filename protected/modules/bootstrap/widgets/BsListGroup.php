<?php

/**
 * BsListGroup class file.
 * @author beer (Amelevich Ilya) <ilya.amelevich@ya.ru>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap/widgets
 */
Yii::import('bootstrap.components.BSHtml');

/**
 * Bootstrap list group widget.
 * @see http://getbootstrap.com/components/#list-group
 */
class BsListGroup extends CWidget {

    /**
     * Options:
     * <table>
     * <tr>
     *  <th>Name</th>
     *  <th>Type</th>
     *  <th>Description</th>
     * </tr>
     * <tr>
     *  <td>label</td>
     *  <td>string</td>
     *  <td>label of list item.</td>
     * </tr>
     * <tr>
     *  <td>title</td>
     *  <td>boolean</td>
     *  <td>Is title, or just text.</td>
     * </tr>
     * <tr>
     *  <td>content</td>
     *  <td>string</td>
     *  <td>content of list item.</td>
     * </tr>
     * <tr>
     *  <td>color</td>
     *  <td>string</td>
     *  <td>color(default, primary, success, warring, danger)</td>
     * </tr>
     * <tr>
     *  <td>url</td>
     *  <td>array, string</td>
     *  <td>url of list item.</td>
     * </tr>
     * <tr>
     *  <td>visible</td>
     *  <td>boolean</td>
     *  <td>visible of element.</td>
     * </tr>
     * <tr>
     *  <td>active</td>
     *  <td>boolean</td>
     *  <td>is element active?</td>
     * </tr>
     * <tr>
     *  <td>htmlOptions</td>
     *  <td>array</td>
     *  <td>the HTML attributes for the list item.</td>
     * </tr>
     * </table>
     * @var array() items.
     */
    public $items = array();

    /**
     * @var array the HTML attributes for the list group.
     */
    public $htmlOptions = '';

    /**
     * Runs the widget.
     */
    public function run() {
        $content = '';

        foreach ($this->items as $item) {
            if (!isset($item['visible'])) {
                $item['visible'] = true;
            }
            if (!isset($item['title'])) {
                $item['title'] = true;
            }
            if (!isset($item['active'])) {
                $item['active'] = false;
            }
            if ($item['visible']) {
                $linkContent = '';
                if (!isset($item['content'])) {
                    if ($item['title']) {
                        $linkContent .= BSHtml::tag('h4', array('class' => 'list-group-item-heading'), $item['label']);
                    } else {
                        $linkContent .= $item['label'];
                    }
                } else {
                    $linkContent .= BSHtml::tag('h4', array('class' => 'list-group-item-heading'), $item['label']);
                    $linkContent .= BSHtml::tag('p', array('class' => 'list-group-item-text'), $item['content']);
                }
                if (!isset($item['url'])) {
                    $item['url'] = '#';
                }
                $colorClassName = 'list-group-item-';
                $colorClassName .= (!isset($item['htmlOptions']['color'])) ? BSHtml::BUTTON_COLOR_DEFAULT : $item['htmlOptions']['color'];
                BSHtml::addCssClass('list-group-item', $item['htmlOptions']);
                BSHtml::addCssClass($colorClassName, $item['htmlOptions']);
                if ($item['active']) {
                    BSHtml::addCssClass('active', $item['htmlOptions']);
                }
                $content .= BSHtml::link($linkContent, $item['url'], $item['htmlOptions']);
            }
        }
        BSHtml::addCssClass('active', $this->htmlOptions);
        echo BSHtml::tag('div', $this->htmlOptions, $content);
    }

}
