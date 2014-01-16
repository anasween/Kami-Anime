<?php if($profile && !$profile->isNewRecord && $profile->getProfileFields()) 
{ 
    $data = array();
    $attributes = array();
    foreach($profile->getProfileFields() as $field) 
    { 
        $data[$field] = $profile->$field;
        $attributes[] = array(
            'name' => $field,
            'label' => Yum::t($field),
        );       
    }   
    $this->widget(
        'bootstrap.widgets.BsDetailView',
        array(
            'data' => $data,
            'attributes' => $attributes,
        )
    );
} 
?>

<div class="clear"></div>
