<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config = array(
    'categoryForm' => array(
        array(
            'field' => 'cat_title',
            'label' => 'cat_title',
            'rules' => 'required'
        ),
        array(
            'field' => 'cat_title',
            'label' => 'cat_title',
            'rules' => 'callback_sales_category_check'
        ),
    ),
    'subCategoryForm' => array(
        array(
            'field' => 'cat_title',
            'label' => 'cat_title',
            'rules' => 'required'
        ),
        array(
            'field' => 'cat_title',
            'label' => 'cat_title',
            'rules' => 'callback_sales_subcategory_check'
        ),
    ),
    'salesContentForm' => array(
        array(
            'field' => 'content_title',
            'label' => 'content_title',
            'rules' => 'required'
        ),
        array(
            'field' => 'content_title',
            'label' => 'content_title',
            'rules' => 'callback_sales_content_check'
        ),
        array(
            'field' => 'sales_content',
            'label' => 'sales_content',
            'rules' => 'required'
        ),
    ),
    'open_ticket' => array(
        array(
            'field' => 'subject',
            'label' => 'Subject Field Required',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'description',
            'label' => 'Description Field Required',
            'rules' => 'trim|required'
        )
    ),
    'response_ticket' => array(
        array(
            'field' => 'response',
            'label' => 'Reply Field Required',
            'rules' => 'trim|required'
        )
    ),
    'vendor_profile' => array(
        array(
            'field' => 'user_name',
            'label' => 'Name field required',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'mobile_no',
            'label' => 'The Please Enter Mobile field must contain a unique value.',
            'rules' => 'trim|required|callback_check_unique_mobile'
        )
    )
);

//$this->form_validation->set_rules('email', 'Email', 'callback_vendor_email_check');			   