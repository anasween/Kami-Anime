<?php 
$module = Yii::app()->getModule('user');
$this->beginContent($module->baseLayout); 
?>

<div class="row">
    <div class="col-md-12">
        <?php Yum::renderFlash(); ?>
        <?php 
        if(Yum::hasModule('message')) {
                Yii::import('application.modules.message.components.*');
                $this->widget('MessageWidget');
        }
        if(Yum::hasModule('profile') && Yum::module('profile')->enableProfileVisitLogging) {
                Yii::import('application.modules.profile.components.*');
                $this->widget('ProfileVisitWidget'); 
        }
        echo $content;  
        ?>
    </div>
</div>

<?php $this->endContent();
