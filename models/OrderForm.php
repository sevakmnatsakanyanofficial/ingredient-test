<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * OrderForm is the model behind the order form.
 */
class OrderForm extends Model
{
    public $ingredients;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['ingredients', 'required'],
            ['ingredients', 'each', 'rule' => ['integer']],
            ['ingredients', function ($attribute, $params) {
                if (count($this->$attribute) < 2 || count($this->$attribute) > 5) {
                    $this->addError($attribute, 'You need choose 2 - 5 ingredients.');
                }
            }],
        ];
    }

    public function formName()
    {
        return '';
    }
}
