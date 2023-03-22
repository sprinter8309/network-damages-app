<?php
use yii\helpers\Html;
$this->title = 'Добавление повреждения';
?>

<?php if (!empty($message)): ?>
    <div class="app-message">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="damage-manage-container">
    <?= $this->render('_form', [
        'damage_model'=>$manage_damage_data_dto->damage_model,
        'name_button_action'=>'Добавить запись о повреждении',
        'branches'=>$manage_damage_data_dto->branches,
        'heating_nodes'=>$manage_damage_data_dto->heating_nodes
    ]); ?>
</div>