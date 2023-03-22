<?php

namespace app\models\dto;

use app\components\dto\AbstractDto;

/**
 * DTO-класс для форм редактирования
 * 
 * @author Oleg Pyatin
 */
class ManageDamageDataDto extends AbstractDto
{
    /**
     * @var array Список филиалов
     */
    public $branches;
    /**
     * @var array  Список тепловых узлов
     */        
    public $heating_nodes;
    /**
     * @var Damage  Модель для хранения данных о повреждении
     */
    public $damage_model;
}
