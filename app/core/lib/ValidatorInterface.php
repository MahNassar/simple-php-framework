<?php

namespace core\database;

interface ValidatorInterface
{
	/**
	 * get validation rules of model
	 * @return array
	 * */
    public static function rules();

    /**
     * validate params compared to model rules
     * @param Array $prams
     * @return Array $error
     **/
    public function getValidationErrors(Array $params);
}
