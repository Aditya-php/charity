<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  File: /application/core/Common_Controller.php
 */
class Common_Controller extends CI_Controller 
{
    //public $currency;
    //public $dateFormat;
    public function __construct()
    {
        // @call to parent CI_Controller constructor
        parent::__construct();
        //$this->currency=getActiveCurrency();
    }
}//end class