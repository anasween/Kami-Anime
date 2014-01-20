<?php
/* @var $this NewsController */
/* @var $model News */
$this->breadcrumbs = array(
            Yum::t('News')=>array('index'),
            $model->title,
        );
?>
<div class="row">
    <div class="col-md-12">
        <?php
            $this->renderPartial('_shortView', array('model'=>$model));
        ?>
        <?php
            echo BSHtml::Button(Yum::t('Write a comment'), array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY,
                'icon' =>  BSHtml::GLYPHICON_COMMENT,
                'onClick' => "$('#comment-add-form').toggle(500)",
                'style' => 'margin: 10px',
            ));
        ?>
        <div id="comment-add-form" style="overflow: hidden; display: block;">
            <?php $this->renderPartial('//comments/_form', array('model'=>$commentModel)); ?>
        </div>
        <?php
            $this->widget('bootstrap.widgets.BsListView', array(
                'dataProvider'=>$comments,
                'itemView'=>'_comment', 
                'template'=>"{items}\n{pager}"
            )); 
        ?>
    </div>
</div>
<?php
    Yii::app()->clientScript->registerScript('helloscript',"
        $('#comment-add-form').toggle(500);
    ",CClientScript::POS_READY);
?>