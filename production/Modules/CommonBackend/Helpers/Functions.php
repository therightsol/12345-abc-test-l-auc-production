<?php
/**
 * Created by PhpStorm.
 * User: abcd
 * Date: 10-Feb-17
 * Time: 1:28 PM
 */

    function check_val($value, $return = ''){

        if (! isset($value) || empty ($value))
            return $return;


        return $value;


    }

    function ValOrNull(&$variable){
        return (isset($variable))? $variable: null;
    }