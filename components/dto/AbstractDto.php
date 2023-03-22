<?php

namespace app\components\dto;

use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Общий класс для вспомогательной DTO функциональности
 */
abstract class AbstractDto extends BaseObject
{
    /**
     * @param array $data
     *
     * @return static
     * @throws ReflectionException
     */
    public static function loadFromArray(array $data): self
    {
        $dto = new static();

        foreach ($dto->attributes() as $attribute) {
            $dto->$attribute ??= $data[$attribute];
        }

        return $dto;
    }

    /**
     * @param Model $model
     * @param array $data
     *
     * @return static
     * @throws ReflectionException
     * @throws InvalidConfigException
     * @throws Exception
     */
    public static function loadFromActiveForm(Model $model, array $data): self
    {
        return self::loadFromArray(ArrayHelper::getValue($data, $model->formName()));
    }

    /**
     * @param bool $excludeSetters
     *
     * @return array
     * @throws ReflectionException
     */
    public function attributes($excludeSetters = false): array
    {
        $class = new ReflectionClass($this);
        $attributes = [];

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                $attributes[] = $property->getName();
            }
        }

        if (!$excludeSetters) {
            foreach ($class->getProperties(ReflectionProperty::IS_PROTECTED) as $property) {
                if (!$property->isStatic()) {
                    $name = substr($property->getName(), 1);

                    if ($class->hasMethod('set' . $name)) {
                        $attributes[] = $name;
                    }
                }
            }
        }

        return $attributes;
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    public function toArray(): array
    {
        return ArrayHelper::toArray($this, $this->attributes());
    }
}
