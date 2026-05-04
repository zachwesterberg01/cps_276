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
    'password' => [
        'type'     => 'text',
        'regex'    => 'password',
        'label'    => '*Password',
        'name'     => 'password',
        'id'       => 'password',
        'errorMsg' => 'Password is required.',
        'error'    => '',
        'required' => true,
        'value'    => ''
    ],
    'status' => [
        'type'     => 'select',
        'label'    => '*Status',
        'name'     => 'status',
        'id'       => 'status',
        'errorMsg' => 'You must select a status.',
        'error'    => '',
        'selected' => '0',
        'required' => true,
        'options'  => [
            '0'     => 'Please Select a Status',
            'staff' => 'staff',
            'admin' => 'admin'
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

        
        $checkSql = "SELECT * FROM admins WHERE email = :email";
        $checkBindings = [
            [':email', $_POST['email'], 'str'],
        ];
        $existing = $pdo->selectBinded($checkSql, $checkBindings);

        if ($existing !== 'error' && count($existing) > 0) {
            $formConfig['email']['error'] = 'That email address already exists.';
            $formConfig['masterStatus']['error'] = true;
        }
        else {
            $name = trim($_POST['fname']) . ' ' . trim($_POST['lname']);
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO admins (name, email, password, status)
                    VALUES (:name, :email, :password, :status)";

            $bindings = [
                [':name',     $name,              'str'],
                [':email',    $_POST['email'],     'str'],
                [':password', $hash,               'str'],
                [':status',   $_POST['status'],    'str'],
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'error') {
                $acknowledgment = "<p style='color:red'>There was an error adding the record.</p>";
            }
            else {
                $acknowledgment = "<p style='color:green'>Admin Added</p>";
                
                $formConfig['fname']['value']      = '';
                $formConfig['lname']['value']      = '';
                $formConfig['email']['value']      = '';
                $formConfig['password']['value']   = '';
                $formConfig['status']['selected']  = '0';
            }
        }
    }
}
?>
