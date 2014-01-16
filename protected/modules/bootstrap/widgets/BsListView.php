<?php
/**
 * BsListView class file.
 * @author Pascal Brewing
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap/widgets
 */

Yii::import('zii.widgets.CListView');

/**
 * Bootstrap Zii list view.
 */
class BsListView extends CListView
{
    /**
     * @var string the CSS class name for the pager container. Defaults to 'pagination'.
     */
    public $pagerCssClass = 'pagination';
    /**
     * @var array the configuration for the pager.
     * Defaults to <code>array('class'=>'ext.bootstrap.widgets.BsPager')</code>.
     */
    public $pager = array('class' => 'bootstrap.widgets.BsPager');
    /**
     * @var string the URL of the CSS file used by this detail view.
     * Defaults to false, meaning that no CSS will be included.
     */
    public $cssFile = false;
    /**
     * @var string the template to be used to control the layout of various sections in the view.
     */
    public $template = "<div class=\"row\"><div class=\"col-md-12\" style=\"text-align: center;\">{summary}</div></div><div class=\"row\"><div class=\"col-md-12\">{items}</div></div>\n<div class=\"row\"><div class=\"col-md-12\" style=\"text-align: center;\">{pager}</div></div>";

    /**
     * Renders the empty message when there is no data.
     */
    public function renderEmptyText()
    {
        $emptyText = $this->emptyText === null ? Yii::t('zii', 'No results found.') : $this->emptyText;
        echo BSHtml::tag('div', array('class' => 'empty', 'col-md-' => 12), $emptyText);
    }
    
    /**
    * Renders the sorter.
    */
    public function renderSorter()
    {
        if($this->dataProvider->getItemCount()<=0 || !$this->enableSorting || empty($this->sortableAttributes))
        {
            return;
        }
        echo CHtml::openTag('div',array('class'=>$this->sorterCssClass))."\n";
        echo $this->sorterHeader===null ? Yii::t('zii','Sort by: ') : $this->sorterHeader;
        echo "<ul>\n";
        $sort=$this->dataProvider->getSort();
        foreach($this->sortableAttributes as $name=>$label)
        {
            echo "<li>";
            if(is_integer($name))
            {
                echo $sort->link($label,Yum::t($label) . ' <span class="caret"></span>');
            }
            else
            {
                echo $sort->link($name,Yum::t($label) . ' <span class="caret"></span>');
            }
            echo "</li>\n";
        }
        echo "</ul>";
        echo $this->sorterFooter;
        echo CHtml::closeTag('div');
    }
}
