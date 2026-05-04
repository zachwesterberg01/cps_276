<?php
require_once 'classes/StickyForm.php';
require_once 'classes/Pdo_methods.php';

$acknowledgment = "<p></p>";

$formConfig = [
    'fname' => [
        'type'     => 'text',
        'regex'    => 'name',
        'label'    => '*First Name',
        'name'     => 'fname',
        'id'       => 'fname',
        'errorMsg' => 'First name is required and can only contain letters, spaces, hyphens, and apostrophes.',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'lname' => [
        'type'     => 'text',
        'regex'    => 'name',
        'label'    => '*Last Name',
        'name'     => 'lname',
        'id'       => 'lname',
        'errorMsg' => 'Last name is required and can only contain letters, spaces, hyphens, and apostrophes.',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'address' => [
        'type'     => 'text',
        'regex'    => 'address',
        'label'    => '*Address',
        'name'     => 'address',
        'id'       => 'address',
        'errorMsg' => 'Address is required and must start with a number.',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'city' => [
        'type'     => 'text',
        'regex'    => 'name',
        'label'    => '*City',
        'name'     => 'city',
        'id'       => 'city',
        'errorMsg' => 'City is required and can only contain letters.',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'state' => [
        'type'     => 'select',
        'label'    => '*State',
        'name'     => 'state',
        'id'       => 'state',
        'errorMsg' => 'You must select a state.',
        'error'    => '',
        'selected' => '0',
        'required' => true,
        'options'  => [
            '0'  => 'Please Select a State',
            'mi' => 'Michigan',
            'oh' => 'Ohio',
            'in' => 'Indiana',
            'il' => 'Illinois',
            'wi' => 'Wisconsin'
        ]
    ],
    'phone' => [
        'type'     => 'text',
        'regex'    => 'phone',
        'label'    => '*Phone',
        'name'     => 'phone',
        'id'       => 'phone',
        'errorMsg' => 'Phone is required and must use the format 999.999.9999.',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'email' => [
        'type'     => 'text',
        'regex'    => 'email',
        'label'    => '*Email',
        'name'     => 'email',
        'id'       => 'email',
        'errorMsg' => 'Email is required and must be a valid email address.',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'dob' => [
        'type'     => 'text',
        'regex'    => 'dob',
        'label'    => '*Date of Birth',
        'name'     => 'dob',
        'id'       => 'dob',
        'errorMsg' => 'Date of birth is required and must use the format mm/dd/yyyy.',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'age' => [
        'type'     => 'radio',
        'label'    => '*Choose an Age Range',
        'name'     => 'age',
        'id'       => 'age',
        'errorMsg' => 'You must select an age range.',
        'error'    => '',
        'required' => true,
        'options'  => [
            ['value' => '0-17',  'label' => '0-17',  'checked' => false],
            ['value' => '18-30', 'label' => '18-30', 'checked' => false],
            ['value' => '30-50', 'label' => '30-50', 'checked' => false],
            ['value' => '50+',   'label' => '50+',   'checked' => false],
        ]
    ],
    'contacts' => [
        'type'     => 'checkbox',
        'label'    => 'Select One or More Options',
        'name'     => 'contacts',
        'id'       => 'contacts',
        'errorMsg' => '',
        'error'    => '',
        'required' => false,
        'options'  => [
            ['value' => 'newsletter', 'label' => 'newsletter', 'checked' => false],
            ['value' => 'email',      'label' => 'email',      'checked' => false],
            ['value' => 'text',       'label' => 'text',       'checked' => false],
        ]
    ],
    'masterStatus' => [
        'error' => false
    ]
];

$stickyForm = new StickyForm();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $formConfig = $stickyForm->validateForm($_POST, $formConfig);

    if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {

        $pdo = new PdoMethods();

        
        $contactsStr = isset($_POST['contacts']) ? implode(',', $_POST['contacts']) : '';

        $sql = "INSERT INTO contacts (fname, lname, address, city, state, phone, email, dob, contacts, age)
                VALUES (:fname, :lname, :address, :city, :state, :phone, :email, :dob, :contacts, :age)";

        $bindings = [
            [':fname',    $_POST['fname'],   'str'],
            [':lname',    $_POST['lname'],   'str'],
            [':address',  $_POST['address'], 'str'],
            [':city',     $_POST['city'],    'str'],
            [':state',    $_POST['state'],   'str'],
            [':phone',    $_POST['phone'],   'str'],
            [':email',    $_POST['email'],   'str'],
            [':dob',      $_POST['dob'],     'str'],
            [':contacts', $contactsStr,      'str'],
            [':age',      $_POST['age'],     'str'],
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            $acknowledgment = "<p style='color:red'>There was an error adding the record.</p>";
        }
        else {
            $acknowledgment = "<p style='color:green'>Contact Information Added</p>";
            
            $formConfig['fname']['value']    = '';
            $formConfig['lname']['value']    = '';
            $formConfig['address']['value']  = '';
            $formConfig['city']['value']     = '';
            $formConfig['state']['selected'] = '0';
            $formConfig['phone']['value']    = '';
            $formConfig['email']['value']    = '';
            $formConfig['dob']['value']      = '';
            foreach ($formConfig['age']['options'] as &$opt) { $opt['checked'] = false; }
            foreach ($formConfig['contacts']['options'] as &$opt) { $opt['checked'] = false; }
        }
    }
}
?>
