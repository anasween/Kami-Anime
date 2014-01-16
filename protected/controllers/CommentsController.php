<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentsController
 *
 * @author beer
 */
class CommentsController extends Controller
{
    public function accessRules() 
    {
        return array(
            array('allow',
                'actions'=>array('index', 'view'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array(
                    'admin',
                    'delete',
                    'create',
                    'update',
                    'index',
                    'view'
                ),
                'expression' => 'Yii::app()->user->isAdmin()'
            ),
            array('allow',
                'actions'=>array('update'),
                'expression' => 'Yii::app()->user->can("comments", "update")'
            ),
            array('allow',
                'actions'=>array('create'),
                'expression' => 'Yii::app()->user->can("comments", "create")'
            ),
            array('allow',
                'actions'=>array('admin'),
                'expression' => 'Yii::app()->user->can("comments", "admin")'
            ),
            array('deny',  // deny all other users
                'users'=>array('*'),
            ),
        );
    }
}
