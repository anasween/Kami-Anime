<?php
$this->breadcrumbs = array(
            Yum::t('Usergroups')=>array('index'),
            $model->title,
        );
?>
<h3> <?php echo $model->title;  ?> </h3>
<div class="item">
    <?php 
    echo BSHtml::bold(Yum::t('Description') . ':');
    echo BSHtml::tag('p',array(),$model->description);
    ?>
    <?php
    if($model->owner)
    {
        echo BSHtml::bold(Yum::t('Owner') . ':');
        echo BSHtml::tag('p',array(),$this->renderPartial('application.modules.user.views.user._view', array('data' => $model->owner),true,true));
    }
    ?>
</div>
<h3><?php echo Yum::t('Participants'); ?></h3>
<div class="item">
    <?php
    $this->widget('bootstrap.widgets.BsListView', array(
        'dataProvider' => $model->getParticipantDataProvider(),
        'itemView' => '_participant', 
        'template' => '{items}{pager}'
    )); 
    ?>
</div>
<div class="clearfix"></div>
<h3><?php echo Yum::t('Messages'); ?></h3>
<?php
$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider' => $model->getCommentsDataProvider(),
    'itemView' => '_message', 
)); 
?>

<?php 
if (Yii::app()->user->can("comment", "create") 
        && (is_array($model->participants) && in_array(Yii::app()->user->id, $model->participants))
        || Yii::app()->user->isAdmin())
{
    echo BSHtml::Button(Yum::t('Write a comment'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_COMMENT,
        'onClick' => "$('#comment-add-form').toggle(500)",
        'style' => 'margin: 10px',
    ));
    echo BSHtml::tag('div', array(
        'id' => 'comment-add-form',
        'style' => 'overflow: hidden; display: block;',
    ), $this->renderPartial('_message_form', array('model' => $commentModel),true,true));
}
?>
<?php
    Yii::app()->clientScript->registerScript('helloscript',"
        $('#comment-add-form').toggle(500);
    ",CClientScript::POS_READY);