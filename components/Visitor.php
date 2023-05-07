<?php

namespace app\components;

use Yii;
use yii\base\component;
use app\models\Visit;

use app\models\Page;
use app\models\Puzzle;
use app\modules\weblog\models\Posts;

class Visitor extends component
{
	public function get_ip()    
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];
        return $ip;
    }

    public function check()
    {
    	$param = Visit::find()->where(['ip'=>$this->get_ip(), 'date'=>date("Y-m-d 00:00:00")])->one();
    	if($param == null)
    	{
    		$model = new Visit;
    		$model->ip = $this->get_ip();
    		$model->date = date("Y-m-d 00:00:00");
    		if(!$model->save())
    		{
    			die(var_dump($model->errors));
    		}
    	}

    }

    public function visitor($param) {
    	return Visit::find()->where(['date'=>$param])->count();
    }

    public function eventNum ($day) {
        $days = $day * 86400;
        $min  = strtotime(date("Y-m-d 00:00:00")) - $days;
        $max  = $min + 86400;

        $posts  = Posts::find()->where(['<=', 'date', $max])->andWhere(['>=', 'date', $min])->all();
        $puzzle = Puzzle::find()->where(['<=', 'date', $max])->andWhere(['>=', 'date', $min])->all();
        $page   = Page::find()->where(['<=', 'date', $max])->andWhere(['>=', 'date', $min])->all();

        return (count($posts) + count($puzzle) + count($page));
    }
}