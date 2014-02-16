<?php
/**
 * BsPanelGroup class file.
 * @author beer (Amelevich Ilya) <ilya.amelevich@ya.ru>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap/widgets
 */

Yii::import('bootstrap.behaviors.BsWidget');
Yii::import('bootstrap.components.BSHtml');

/**
 * Bootstrap panel group widget.
 * @see http://getbootstrap.com/javascript/#collapse
 */
class BsPanelGroup extends CWidget {
   
    /**
     * Options:
     * <table>
     * <tr>
     *  <th>Name</th>
     *  <th>Type</th>
     *  <th>Description</th>
     * </tr>
     * <tr>
     *  <td>header</td>
     *  <td>string</td>
     *  <td>header of panel item.</td>
     * </tr>
     * <tr>
     *  <td>title</td>
     *  <td>boolean</td>
     *  <td>Is title, or just text.</td>
     * </tr>
     * <tr>
     *  <td>body</td>
     *  <td>string</td>
     *  <td>body of panel item.</td>
     * </tr>
     * <tr>
     *  <td>footer</td>
     *  <td>string</td>
     *  <td>footer of panel item.</td>
     * </tr>
     * <tr>
     *  <td>color</td>
     *  <td>string</td>
     *  <td>color(default, primary, success, warring, danger)</td>
     * </tr>
     * <tr>
     *  <td>htmlOptions</td>
     *  <td>array</td>
     *  <td>the HTML attributes for the list item.</td>
     * </tr>
     * </table>
     * @var array() items.
     */
    public $items = '';
    
    /**
     * @var boolean is collapse. 
     */
    public $collapse = false;
    
    /**
     * @var array the HTML attributes for the navbar.
     */
    public $htmlOptions = '';
    
    private $_idIndex;
    
    /**
     * Initializes the widget.
     */
    public function init()
    {
        $this->attachBehavior('BsWidget', new BsWidget);
        $this->copyId();
        $this->_idIndex = 0;
    }
    
    /**
     * Runs the widget.
     */
    public function run() {
        $groupContent = '';
        foreach ($this->items as $item) {
            $content = '';
            $this->issetItems($item);
            if ($item['header'] !== '') {
                if ($this->collapse) { 
                    $item['header'] = BSHtml::link($item['header'], '#'.$this->htmlOptions['id'].'-'.$this->_idIndex, array(
                        'data-toggle' => 'collapse',
                        'data-parent' => '#'.$this->htmlOptions['id']
                    ));
                }
                if ($item['title']) {
                    $title = BSHtml::tag('div', array('class' => 'panel-title'), $item['header']);
                    $content .= BSHtml::tag('div', array('class' => 'panel-heading'), $title);
                    unset($title);
                } else {
                    $content .= BSHtml::tag('div', array('class' => 'panel-heading'), $item['header']);
                }
            }
            if ($item['body'] !== '') {
                $collapsedContent = BSHtml::tag('div', array('class' => 'panel-body'), $item['body']);
            }
            if ($item['footer'] !== '') {
                $collapsedContent = BSHtml::tag('div', array('class' => 'panel-footer'), $item['footer']);
            }
            if ($this->collapse) {
                $content .= BSHtml::tag('div', array(
                        'id' => $this->htmlOptions['id'].'-'.$this->_idIndex,
                        'class' => 'panel-collapse collapse'
                    ), $collapsedContent);
                $this->_idIndex += 1;
            } else {
                $content .= $collapsedContent;
            }
            BSHtml::addCssClass('panel panel-' . $item['color'], $item['htmlOptions']);               
            $groupContent .= BSHtml::tag('div', $item['htmlOptions'], $content);
            unset($content);
        }
        BSHtml::addCssClass('panel-group', $this->htmlOptions);     
        echo BSHtml::tag('div', $this->htmlOptions, $groupContent);
    }
    
    private function issetItems(&$item) {
        if(!isset($item['header'])) {
            $item['header'] = '';
        }
        if(!isset($item['body'])) {
            $item['body'] = '';
        }
        if(!isset($item['footer'])) {
            $item['footer'] = '';
        }
        if(!isset($item['title'])) {
            $item['title'] = true;
        }
        if(!isset($item['color'])) {
            $item['color'] = BSHtml::BUTTON_COLOR_DEFAULT;
        }
        if(!isset($item['htmlOptions'])) {
            $item['htmlOptions'] = array();
        }
        return $item;
    }
    
}
