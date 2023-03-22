<?php
use app\helpers\UrlTransform;
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Список повреждений теплосети';
?>

<?php if (!empty($message)): ?>
    <div class="app-message">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="damage-list-container">
    <h3>Список текущих повреждений</h3>
    
    <?php
    echo GridView::widget([
        'dataProvider'=>$damage_data_provider,
        'columns'=>[
            [
                'label'=>'Филиал',
                'headerOptions'=>['width'=>120],
                'content'=>function ($data) {
                    return $data->branch->name;
                }
            ],
            [
                'label'=>'Тепловой узел',
                'headerOptions'=>['width'=>160],          
                'content'=>function ($data) {
                    return $data->heatingNode->name;
                }
            ],        
            [
                'attribute'=>'emergence_time',
                'label'=>'Время регистрации повреждения',
                'contentOptions'=>[
                    'class'=>'list-grid-name-param'
                ]
            ], 
            [
                'attribute'=>'leakage_size',
                'label'=>'Величина утечки',
                'contentOptions'=>[
                    'class'=>'list-grid-name-param'
                ]
            ],                    
            [
                'class'=>'yii\grid\ActionColumn',
                'headerOptions'=>['width'=>50],
                'template'=>'{update}{delete}',
                'buttons'=>[
                    'update'=>function ($url, $model) {
                        return Html::a('&#9998;', 'damage/update/'.UrlTransform::getIdFromUrl($url), ['class'=>'grid-table-button']);
                    },
                    'delete'=>function ($url, $model) {
                        return Html::a('&#10006;', 'damage/delete/'.UrlTransform::getIdFromUrl($url), ['class'=>'grid-table-button']);
                    }
                ]
            ]
        ],
        'summaryOptions'=>[
            'class'=>'list-grid-summary'
        ],
        'layout'=>'{summary}{items}<div class="catalog-tile-pager">{pager}</div>',
        'rowOptions'=>[
            'class'=>'list-grid-row'
        ],
        'tableOptions'=>[
            'class'=>'list-grid-table'
        ],
        'options'=>[
            'class'=>'list-grid-container'
        ]
    ]);
    ?>
    
    <?= Html::a('Добавить запись о повреждении', '/damage/create', ['class'=>'standart-button damage-list-add-button']) ?>
    
</div>
