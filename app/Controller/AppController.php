<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       Cake.Console.Templates.skel.Controller
 */
class AppController extends Controller {
    public $helpers = Array( 'Form', 'Session' );

// default user settings
    var $user_info      = null;
    var $user_id        = null;
    var $user_role      = 'guest';

// default authentication URL
    var $auth_url       = '/users/login';

// pre-defined access array (will be defined in controllers, that extends AppController)
    var $access         = array();

/**
 * Override beforeFilter method
 *  - Loading user-data from session ( if user is logged in )
 *  - checking access ( based on access array )
 * @return void
 */
    function beforeFilter() {
        // loading current user info
        // this value should be write to session in UsersController->login or UsersController->profile
        if ( $this->Session->check( "User" ) ) {
            $this->user_info = $this->Session->read( "User" );
            $this->user_role = $this->user_info['role'];
            $this->user_id = $this->user_info['id'];
        } else {
            $this->user_info   = null;
            $this->user_id     = null;
            $this->user_role   = 'guest';
        }

        // setting user's info for views
        $this->set( 'User', $this->user_info );

        // checking access
        if ( !$this->checkAccess( $this->action, $this->access ) ) {
        	$this->Session->write( 'before_login_url', $this->here );
        	$this->redirect( $this->auth_url );
        }
    }

/**
 * Check access function (ACL - like)
 * based on $controller->access = array( 'method'=>array( 'role1', 'role2' ... 'roleN' ) )
 *
 * @param String $action
 * @param Array $access
 * @return Boolean
 */
    function checkAccess( $action, $access = '' ) {
        $result = true;
        if ( is_array( $access ) && array_key_exists( $action, $access ) ) {
            if ( array_key_exists( 'role', $access[$action] ) ) {
                if ( in_array( $this->user_role, $access[$action]['role'])) {
                    $result =  false;
                }
            } else {
                if ( !in_array( $this->user_role, $access[$action] ) ) {
                     $result = false;
                }
            }
        }
        return $result;
    }

/**
 * Method for attach dependnt datasets into one
 *
 * @param array $source
 * @param string $className
 * @param string $field
 * @param string $value
 * @return array with $source[$className][$field] == $value
 */
    function __findDataBlock( &$source, $className, $field, $value ) {
        $result = array();
        if ( !empty( $source ) ) {
            foreach ( $source as $key => $row ) {
                if ( $row[$className][$field] == $value ) {
                    $result[] = $row;
                }
            }
            if ( !empty( $result ) && count( $result ) == 1 && isset( $result[0] ) ) {
                $result = $result[0];
            }

        }

        return $result;
    }

}
