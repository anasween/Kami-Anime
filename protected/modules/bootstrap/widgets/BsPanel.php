<?php
/**
 * BsNavbar class file.
 * @author beer (Amelevich Ilya) <ilya.amelevich@ya.ru>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap/widgets
 */

Yii::import('bootstrap.components.BSHtml');

/**
 * Bootstrap panel widget.
 * @see http://getbootstrap.com/components/#panels
 */
class BsPanel extends CWidget {
   
    /**
     * @var string header content. 
     */
    public $header = '';
    
    /**
     * @var boolean have title. 
     */
    public $title = false;
    
    /**
     * @var string body content.
     */
    public $body = '';
    
    /**
     * @var string footer content.
     */
    public $footer = '';
    
    /**
     * @var array the HTML attributes for the navbar.
     */
    public $htmlOptions = '';
    
    /**
     * Panel color. Values like in buttons: primary, danger, waring, success, default.
     * @var string 
     */
    public $color = BSHtml::BUTTON_COLOR_DEFAULT;
    
    /**
     * Runs the widget.
     */
    public function run() {
        $content = '';
        if ($this->header !== '') {
            if ($this->title) {
                $title = BSHtml::tag('div', array('class' => 'panel-title'), $this->header);
                $content .= BSHtml::tag('div', array('class' => 'panel-heading'), $title);
                unset($title);
            } else {
                $content .= BSHtml::tag('div', array('class' => 'panel-heading'), $this->header);
            }
        }
        if ($this->body !== '') {
            $content .= BSHtml::tag('div', array('class' => 'panel-body'), $this->body);
        }
        if ($this->footer !== '') {
            $content .= BSHtml::tag('div', array('class' => 'panel-footer'), $this->footer);
        }
        BSHtml::addCssClass('panel panel-' . $this->color, $this->htmlOptions);               
        echo BSHtml::tag('div', $this->htmlOptions, $content);
    }
    
}
