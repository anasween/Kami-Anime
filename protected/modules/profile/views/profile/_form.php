<?php
if(Yum::module()->rtepath != false)
{
    Yii::app()->clientScript-> registerScriptFile(Yum::module()->rtepath);     
}
if(Yum::module()->rteadapter != false)
{
    Yii::app()->clientScript-> registerScriptFile(Yum::module()->rteadapter); 
}

if($profile)
{
    foreach(YumProfile::getProfileFields() as $field) 
    {
        echo $form->TextFieldControlGroup($profile, $field);
    }
}