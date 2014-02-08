<?php
$this->breadcrumbs = array(
            Yum::t('Translation')=>array('admin'),
            sprintf('%s-%s-%s',
            $models[0]->language,
            $models[0]->category,
            $models[0]->message),
            Yum::t('Update'),
        );
echo '<div class="well">';
if($models[0]->isNewRecord)
{
    $header = Yum::t('New translation');
}
else
{
    $header = Yum::t('Update translation {message}', array(
                            '{message}' => $models[0]->message)); 
}
echo BSHtml::pageHeader($header);
echo $this->renderPartial('_form', array('models'=>$models)); 
echo '</div>';
