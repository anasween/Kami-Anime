<?php
$this->pageTitle=Yum::t("Profile");
$this->title = Yum::t('Profile of {username}', array(
    '{username}' => $model->username
));
$this->breadcrumbs = array(Yum::t("Profile"), $model->username); 
?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<table class="dataGrid">
<tr>
    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
    <td><?php echo CHtml::encode($model->username); ?>
</td>
</tr>
<?php 
    $profileFields=YumProfileField::model()->forOwner()->sort()->findAll();
    if ($profileFields) {
            foreach($profileFields as $field) {
?>
<tr>
    <th class="label"><?php echo CHtml::encode(Yum::t($field->title)); ?></th>
    <td><?php echo CHtml::encode($profile->getAttribute($field->varname)); ?>
</td>
</tr>
<?php
            }
    }
?>
<tr>
    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?></th>
    <td><?php echo date(UserModule::$dateFormat,$model->createtime); ?>
</td>
</tr>
<tr>
    <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit')); ?></th>
    <td><?php echo date(UserModule::$dateFormat,$model->lastvisit); ?>
</td>
</tr>
</table>
