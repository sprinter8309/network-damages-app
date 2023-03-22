<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([
        'id' => 'damage_model',
        'options'=>[
        ]
    ]); ?>

    <?= $form->field($damage_model, 'branch_id', ['options'=>['label'=>'Выберите филиал','class'=>'damage-manage-form-field']])
            ->dropdownList($branches)
            ->label('Выберите филиал') ?>

    <?= $form->field($damage_model, 'heating_node_id', ['options'=>['label'=>'Выберите тепловой узел','class'=>'damage-manage-form-field']])
            ->dropdownList($heating_nodes)
            ->label('Выберите тепловой узел') ?>

    <?= $form->field($damage_model, 'leakage_size', ['options'=>['label'=>'Величина утечки', 'class'=>'damage-manage-form-field']])
            ->textInput(['class'=>'damage-manage-field-input', 'placeholder'=>'Введите величину', 'value'=> $damage_model->leaking_size ?? "0.0"])
            ->label('Величина утечки') ?>

    <?= $form->field($damage_model, 'id')->hiddenInput()->label(false); ?>

    <?= Html::submitButton($name_button_action, ['class' => 'standart-button damage-manage-button', 'name' => 'damage-manage-button']) ?>
<?php ActiveForm::end(); ?>
