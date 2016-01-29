<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/15
 * Time: 16:22
 * Desc:
 */

namespace common\models;


use beecloud\rest\api;
use yii\base\Model;


/*
 *
 * 简单的封装了下beeclound
 * */

class BeeClound extends Model
{

	const CHANNEL_ALI_WEB = 'ALI_WEB';

	public $app_id = '8d185da4-aa11-4147-8267-6649381d850d';
	public $app_secret = "17f86f9c-7ce5-4696-9f6f-da9a9f70b2e4";
	public $timestamp = null;
	public $app_sign = '';
	public $channel = '';
	public $total_fee = 1;
	public $bill_no = '';
	public $title = '';
	public $return_url = '';
	public $optional = [];


	public function __construct($channel, $title, $total_fee, $optional, $config = [])
	{
		$this->timestamp = time() * 1000;
		$this->title = $title;
		$this->app_sign = md5($this->app_id . $this->timestamp . $this->app_secret);
		$this->bill_no = 'game4039' . $this->timestamp;
		$this->return_url = 'http://www.4039.com';
		$this->channel = $channel;
		$this->total_fee = $total_fee;
		$this->optional = $optional;
	}

	public function bill()
	{
		$data = [
			'app_id' => $this->app_id,
			'timestamp' => $this->timestamp,
			'app_sign' => $this->app_sign,
			'channel' => $this->channel,
			'total_fee' => $this->total_fee,
			'bill_no' => $this->bill_no,
			'title' => $this->title,
			'return_url' => $this->return_url,
			//'optional' => $this->optional,
		];

		try
		{
			$result = api::bill($data);
			if ($result->result_code != 0)
			{
				echo $result->err_detail;
				exit();
			}
			$htmlContent = $result->html;
			$url = $result->url;
			echo $htmlContent;
		} catch (\Exception $e)
		{
			echo $e->getMessage();
		}
	}

}