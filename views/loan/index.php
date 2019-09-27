<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Loan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'options'      => [
            'class' => 'table-responsive',
        ],
        'tableOptions' => [
            'class' => 'table'
        ],
        'headerRowOptions' => [
                'class'=> 'grid-view-table-header'
        ],
        'dataProvider' => $dataProvider,
        'columns'      => [

            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'user_id',
                'label'     => 'User',
                'value'     => function ($data) {
                    return is_object($data->user) ? $data->user->first_name : 'non-user';
                }
            ],
            'amount',
            'interest',
            'duration',
            'start_date',
            'end_date',
            'campaign',
            'status:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
