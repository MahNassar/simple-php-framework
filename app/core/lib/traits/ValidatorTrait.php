<?php

namespace core\lib\traits;

use Valitron\Validator;

trait ValidatorTrait
{
    /**
     * validation rules
     * @return array
     * */
    public static function rules()
    {
        return [];
    }

    /**
     * validate params compared to validation rules
     * @param Array $prams
     * @return Array $error
     **/
    public function getValidationErrors(Array $params)
    {
        $errors = [];
        $validator = new Validator($params);
        if ($rules = static::rules()) {
            foreach ($rules as $attrName => $attrRules) {
                foreach ($attrRules as $attrRule) {
                    $validator->rule($attrRule, $attrName);
                }
            }
        }
        
        if (!$validator->validate())
            $errors =  $validator->errors();
        return $errors;
    }
}