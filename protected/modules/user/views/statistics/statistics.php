<?php
$this->title = Yum::t('Statistics');

$this->breadcrumbs = array(
            Yum::t('Users') => array('//user/user/index'),
            Yum::t('Statistics')
        );

echo '<div class="well">';

echo BSHtml::pageHeader(Yum::t('Statistics'));

echo '<table class="table">';
echo '<tbody class="table-striped">';
$f = '<tr><td>%s</td><td>%s</td></tr>';
printf($f, Yum::t('Total users'), $total_users);
printf($f, Yum::t('Active users'), $active_users);
printf($f, Yum::t('New users registered today'), $todays_registered_users);
printf($f, Yum::t('Inactive users'), $inactive_users);
printf($f, Yum::t('Banned users'), $banned_users);
printf($f, Yum::t('Admin users'), $admin_users);
printf($f, Yum::t('Different users logged in today'), $logins_today);
echo '</tbody>';
echo '</table>';

echo '</div>';