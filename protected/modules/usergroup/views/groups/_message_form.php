<?php
  echo BSHtml::beginFormBs('//usergroup/groups/write');

    echo CHtml::hiddenField('YumUsergroupMessage[group_id]', $group_id);

    echo BSHtml::textFieldControlGroup('YumUsergroupMessage[title]', isset($title) ? $title : '') . '<br />';

    echo BSHtml::textAreaControlGroup('YumUsergroupMessage[message]', '', array(
                            'cols' => 40, 'rows' => 6,
                            )) . '<br />';

    echo BSHtml::submitButton(Yum::t('Write message'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));

    echo BSHtml::endForm();