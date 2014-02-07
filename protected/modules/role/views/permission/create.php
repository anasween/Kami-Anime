<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'permission-create-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
));
?>

<?php echo $form->errorSummary($model); ?>

<label> <?php echo Yum::t('Do you want to grant this permission to a user or a role'); ?> </label>
<?php 
echo $form->radioButtonList($model, 'type', array(
        'user' => Yum::t('User'),
        'role' => Yum::t('Role'))
    ); 
?>

<div id="assignment_user">
    <?php
    echo $form->LabelEx($model, 'principal_id');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'principal_id',
        'value' => Yii::app()->user->id,
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(YumUser::model()->findAll(), 'id', 'username'),
    )); 
    ?>
    <?php
    echo $form->LabelEx($model, 'subordinate_id');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'subordinate_id',
        'value' => Yii::app()->user->id,
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(YumUser::model()->findAll(), 'id', 'username'),
    )); 
    ?>
    <?php echo $form->dropDownListControlGroup($model,'template', array(
                            '0' => Yum::t('No'),
                            '1' => Yum::t('Yes'),
                        )); ?>

</div>

<div id="assignment_role" style="display: none;">
    <?php
    echo $form->LabelEx($model, 'principal_id');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'principal_id',
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(YumRole::model()->findAll(), 'id', 'title'),
    )); 
    ?>
    <?php
    echo $form->LabelEx($model, 'subordinate_id');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'subordinate_id',
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(YumRole::model()->findAll(), 'id', 'title'),
    )); 
    ?>
</div>

<?php
    echo $form->LabelEx($model, 'action');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'action',
        'value' => Yii::app()->user->id,
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(YumAction::model()->findAll(), 'id', 'title'),
    )); 
    ?>
    <?php
    echo $form->LabelEx($model, 'subaction');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'subaction',
        'value' => Yii::app()->user->id,
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(YumAction::model()->findAll(), 'id', 'title'),
    )); 
?>

<?php echo $form->textAreaControlGroup($model,'comment'); ?>

<?php
    echo BSHtml::submitButton(Yum::t('Create'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php Yii::app()->clientScript->registerScript('type', "
$('#YumPermission_type_0').click(function() {
$('#assignment_role').hide();
$('#assignment_user').show();});

$('#YumPermission_type_1').click(function() {
$('#assignment_role').show();
$('#assignment_user').hide();});

");