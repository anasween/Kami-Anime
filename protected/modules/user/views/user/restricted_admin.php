<?php
$this->title = Yum::t('Manage users');

$this->breadcrumbs = array(
		Yum::t('Users') => array('index'),
		Yum::t('Manage'));

printf('<table><tr><th>%s</th><th>%s</th></tr>', Yum::t('Username'), Yum::t('Actions'));
foreach($users as $user)  
{
    printf('<tr><td>%s</td><td>%s %s</td></tr>',
        $user->username,
        CHtml::link(Yum::t('Details'), array('//user/user/view', 'id' => $user->id)),
        CHtml::link(Yum::t('Update'), array('//user/user/update', 'id' => $user->id))
    );
}
echo '</table>';
