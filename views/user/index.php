<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
$arStatus = app\models\User::getStatusesArray();
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id',
                'contentOptions' => ['style' => "width:50px; text-align:center"],
            ],
            'name',
            'email',
            'phone',
            [
                'attribute'=>'role_id',
                'filter'=>app\models\Role::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value'=>'role.title',
                /*'value'=> function (Section $section) {
			return $section->parent ? $section->parent->title : null;
		}*/
            ],
            [
                'attribute'=>'status',
                'filter'=>$arStatus,
                'value'=>function($data){
                    $arStatus = app\models\User::getStatusesArray();
                    return $arStatus[$data->status];
                },
                'contentOptions' => ['style' => "width:200px;"],
            ],
            //'name',
            // 'phone',
            // 'email:email',
            // 'role_id',
            // 'status',

            ['class' => 'yii\grid\ActionColumn','contentOptions' => ['style' => "width:100px;text-align:center"]],
        ],
    ]); ?>
</div>
