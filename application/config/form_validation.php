<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'pages/manage' => array(
        array(
            'field' => 'title',
            'label' => 'Page title',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'meta_keywords',
            'label' => 'Meta keywords',
            'rules' => "trim|max_length[1024]"
        ),
        array(
            'field' => 'meta_description',
            'label' => 'Meta description',
            'rules' => "trim|max_length[1024]"
        )
    ),
    'packages/manage' => array(
        array(
            'field' => 'name',
            'label' => 'Package Name',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'category',
            'label' => 'Category',
            'rules' => "trim|required"
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim|required|max_length[2000]'
        ),
        array(
            'field' => 'days',
            'label' => 'No. of days',
            'rules' => 'trim|max_length[5]|numeric'
        ),
        array(
            'field' => 'age_limit',
            'label' => 'Age Limit',
            'rules' => 'trim|max_length[5]|numeric'
        )
    ),
    'manage_category' => array(
        array(
            'field' => 'name',
            'label' => 'Category Name',
            'rules' => "trim|required|max_length[200]"
        )
    ),
    'bookings/manage' => array(
        array(
            'field' => 'user',
            'label' => 'User',
            'rules' => "trim|required"
        ),
        array(
            'field' => 'package',
            'label' => 'Package',
            'rules' => "trim|required"
        ),
        array(
            'field' => 'journey_date',
            'label' => 'Journey Date',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'journey_time',
            'label' => 'Journey Time',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'guest_adult',
            'label' => 'Adult',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'guest_child',
            'label' => 'Child',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'guest_infant',
            'label' => 'Infant',
            'rules' => 'trim|numeric'
        ),
        array(
            'field' => 'pickup_location',
            'label' => 'Pickup Location',
            'rules' => 'trim|max_length[255]'
        ),
        array(
            'field' => 'message',
            'label' => 'Infant',
            'rules' => 'trim|max_length[255]'
        )
    ),
    'cities/manage' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => "trim|required|max_length[255]|callback__is_unique_city_name"
        )
    ),
    'email_templates/manage' => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'subject',
            'label' => 'Subject',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'variable',
            'label' => 'Variable',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'trim|required'
        )
    ),
    'add_subadmins' => array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => "trim|required|max_length[50]"
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => "trim|max_length[50]"
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => "trim|required|valid_email|max_length[254]|callback__validate_email"
        ),
        array(
            'field' => 'phone',
            'label' => 'Phone',
            'rules' => "trim|max_length[20]"
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'cpassword',
            'label' => 'Confrim Password',
            'rules' => "trim|matches[password]"
        )
    ),
    'edit_subadmins' => array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => "trim|required|max_length[50]"
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => "trim|max_length[50]"
        ),
        array(
            'field' => 'phone',
            'label' => 'Phone',
            'rules' => "trim|max_length[20]"
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => "trim|max_length[255]"
        ),
        array(
            'field' => 'cpassword',
            'label' => 'Confrim Password',
            'rules' => "trim|matches[password]"
        )
    ),
    'add_users' => array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => "trim|required|max_length[50]"
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => "trim|required|max_length[50]"
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => "trim|required|valid_email|max_length[254]|callback__validate_email"
        ),
        array(
            'field' => 'phone',
            'label' => 'Phone',
            'rules' => "trim|required|max_length[20]"
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'cpassword',
            'label' => 'Confrim Password',
            'rules' => "trim|required|matches[password]"
        ),
        array(
            'field' => 'city',
            'label' => 'City',
            'rules' => "trim|required|max_length[50]"
        ),
        array(
            'field' => 'state',
            'label' => 'State',
            'rules' => "trim|required|max_length[50]"
        )
    ),
    'edit_users' => array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => "trim|required|max_length[50]"
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => "trim|max_length[50]"
        ),
        array(
            'field' => 'phone',
            'label' => 'Phone',
            'rules' => "trim|max_length[20]"
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => "trim|max_length[255]"
        ),
        array(
            'field' => 'cpassword',
            'label' => 'Confrim Password',
            'rules' => "trim|matches[password]"
        )
    ),
    'permissions/manage' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'key',
            'label' => 'Key',
            'rules' => "trim|required|max_length[255]|callback__validate_permission_key"
        ),
        array(
            'field' => 'group',
            'label' => 'group',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'order',
            'label' => 'Order',
            'rules' => "trim|max_length[11]"
        )
    ),
    'flash_messages/manage' => array(
        array(
            'field' => 'value',
            'label' => 'Message',
            'rules' => "trim|required|max_length[1500]"
        ),
        array(
            'field' => 'key',
            'label' => 'Key',
            'rules' => "trim|required|max_length[255]|callback__validate_flash_message_key"
        ),
        array(
            'field' => 'group',
            'label' => 'group',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'order',
            'label' => 'Order',
            'rules' => "trim|max_length[11]"
        )
    ),
    'change_admin_password' => array(
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|callback__validate_password'
        ),
        array(
            'field' => 'new_password',
            'label' => 'New Password',
            'rules' => 'trim|required|min_length[6]|max_length[40]'
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|min_length[6]|max_length[40]|matches[new_password]'
        )
    ),
    'change_admin_profile' => array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => "trim|required|max_length[50]"
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => "trim|max_length[50]"
        ),
        array(
            'field' => 'phone',
            'label' => 'Phone',
            'rules' => "trim|max_length[20]"
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => "trim|max_length[255]"
        ),
        array(
            'field' => 'cpassword',
            'label' => 'Confrim Password',
            'rules' => "trim|matches[password]"
        )
    ),
    'update_profile' => array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => "trim|required|max_length[50]"
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => "trim|max_length[50]"
        ),
        array(
            'field' => 'phone',
            'label' => 'Phone',
            'rules' => "trim|max_length[20]"
        )
    ),
    'sliders/manage' => array(
        array(
            'field' => 'title',
            'label' => 'Slider Title',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim|required|max_length[1500]'
        ),
        array(
            'field' => 'link',
            'label' => 'Link',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'image',
            'label' => 'Image',
            'rules' => "trim|required|max_length[255]"
        )
    ),
    'contact' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => "trim|required|valid_email|max_length[100]"
        ),
        array(
            'field' => 'subject',
            'label' => 'Subject',
            'rules' => "trim|required|max_length[255]"
        ),
        array(
            'field' => 'message',
            'label' => 'Message',
            'rules' => "trim|required|max_length[1000]"
        )
    )
);
$config['error_prefix'] = '<div class="help-block">';
$config['error_suffix'] = '</div>';
