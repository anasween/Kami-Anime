<?php $this->beginContent(Yum::module()->baseLayout); ?>

<div class="row">
    <div class="col-md-12">
        <?php
         if (Yum::module()->debug) {
                echo CHtml::openTag('div', array('class' => 'yumwarning'));
                echo Yum::t(
                                'You are running the Yii User Management Module {version} in Debug Mode!', array(
                                        '{version}' => Yum::module()->version));
                echo CHtml::closeTag('div');
        }

        Yum::renderFlash(); 
        echo $content;  
        ?>
    </div>
    <?php
//    echo '<div class="span3">';
//        
//    if(!Yii::app()->user->isGuest)
//    {
//        echo $this->renderMenu();
//    }
//        
//    echo '</div>'; 
    ?>
</div>

<?php $this->endContent();
