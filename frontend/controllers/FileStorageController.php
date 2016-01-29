<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/3
 * Time: 2:27
 * Desc:
 */

namespace frontend\controllers;


use yii\filters\VerbFilter;
use yii\web\Controller;

class FileStorageController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
					'upload-delete' => ['delete']
				]
			]
		];
	}

	public function actions()
	{
		return [
			'upload' => [
				'class' => 'trntv\filekit\actions\UploadAction',
				'deleteRoute' => 'upload-delete'
			],
			'upload-delete' => [
				'class' => 'trntv\filekit\actions\DeleteAction'
			]
		];
	}

}