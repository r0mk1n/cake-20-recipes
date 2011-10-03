<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       Cake.Console.Templates.skel.Model
 */
class AppModel extends Model {
	var $validationSet = array();

	function __construct( $id = false, $table = null, $ds = null ) {
		parent::__construct( $id, $table, $ds );
		//$this->query( "set names 'utf8'" );
	}

	function setValidation( $setName ) {
		$this->validate = isset( $this->validationSet[$setName] ) ? $this->validationSet[$setName] : null;
	}

/**
 * Set a field as invalid, optionally setting the name of validation
 * rule (in case of multiple validation for field) that was broken
 *
 * @param string $field The name of the field to invalidate
 * @param string $value Name of validation rule that was not met
 * @access public
 */
    function invalidate($field, $value = true) {
        if (!is_array($this->validationErrors)) {
            $this->validationErrors = array();
        }
        if ( isset( $this->validationErrors[$field] ) && strlen( $this->validationErrors[$field] ) && strpos( $this->validationErrors[$field], $value ) === false ) {
        	$this->validationErrors[$field] .= ', ' . $value;
        } else {
        	$this->validationErrors[$field] = $value;
        }
    }

/**
 * Custom validation rules
 *
 */
    
    function otherFieldNotEmpty( $data, $field_to_check ) {
        return ( !empty( $this->data[$this->name][$field_to_check] ) ) ? true : false;
    }


    function equalToField( $data, $field ) {
        $filed_tmp = array_values( $data );
        return $filed_tmp[0] == $this->data[$this->name][$field];
    }

/**
 * $data array is passed using the form field name as the key
 * have to extract the value to make the function generic
 */
    function alphaNumericDashUnderscore( $data ) {
		$value = array_values($data);
		$value = $value[0];
		return preg_match('|^[0-9a-zA-Z_-]*$|', $value);
    }

    function isValidEmail($email) {
// First, we check that there's one @ symbol, and that the lengths are right
        if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
// Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
                return false;
            }
        }
        if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                    return false;
                }
            }
        }
        return true;
    }

}
