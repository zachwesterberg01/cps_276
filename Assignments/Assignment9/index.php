<?php
require_once 'classes/Db_conn.php';
require_once 'classes/Pdo_methods.php';
require_once 'classes/Validation.php';
require_once 'classes/StickyForm.php';

$stickyForm = new StickyForm();
$pdo = new PdoMethods();

$message = "";

$formConfig = [
    "first_name" => [
        "type" => "text",
        "regex" => "name",
        "required" => true,
        "errorMsg" => "You must enter a first name and it must be alpha characters only.",
        "label" => "*First Name",
        "name" => "first_name",
        "id" => "first_name",
        "value" => ""
    ],
    "last_name" => [
        "type" => "text",
        "regex" => "name",
        "required" => true,
        "errorMsg" => "You must enter a last name and it must be alpha characters only.",
        "label" => "*Last Name",
        "name" => "last_name",
        "id" => "last_name",
        "value" => ""
    ],
    "email" => [
        "type" => "text",
        "regex" => "email",
        "required" => true,
        "errorMsg" => "You must enter a email address and it must be in the format of example@example.com.",
        "label" => "*Email",
        "name" => "email",
        "id" => "email",
        "value" => ""
    ],
    "password" => [
        "type" => "text",
        "regex" => "password",
        "required" => true,
        "errorMsg" => "Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)",
        "label" => "*Password",
        "name" => "password",
        "id" => "password",
        "value" => ""
    ],
    "confirm_password" => [
        "type" => "text",
        "regex" => "password",
        "required" => true,
        "errorMsg" => "Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)",
        "label" => "*Confirm Password",
        "name" => "confirm_password",
        "id" => "confirm_password",
        "value" => ""
    ],
    "masterStatus" => [
        "error" => false
    ]
];

if (isset($_POST['submit'])) {
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);

    if (
    empty($formConfig["password"]["error"]) &&
    empty($formConfig["confirm_password"]["error"]) &&
    $_POST["password"] !== $_POST["confirm_password"]
) {
    $formConfig["confirm_password"]["error"] = "Your passwords do not match";
    $formConfig["masterStatus"]["error"] = true;
}

    if (empty($formConfig["masterStatus"]["error"])) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $bindings = [
            [':email', $_POST['email'], 'str']
        ];

        $result = $pdo->selectBinded($sql, $bindings);

        if (count($result) > 0) {
            $message = "There is already a record with that email";
        } else {
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (first_name, last_name, email, password)
                    VALUES (:first_name, :last_name, :email, :password)";

            $bindings = [
                [':first_name', $_POST['first_name'], 'str'],
                [':last_name', $_POST['last_name'], 'str'],
                [':email', $_POST['email'], 'str'],
                [':password', $hashedPassword, 'str']
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'noerror') {
                $message = "You have been added to the database";

                

                $formConfig["first_name"]["value"] = "";
                $formConfig["last_name"]["value"] = "";
                $formConfig["email"]["value"] = "";
                $formConfig["password"]["value"] = "";
                $formConfig["confirm_password"]["value"] = "";
            }
        }
    }
}

$records = $pdo->selectNotBinded("SELECT first_name, last_name, email, password FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 9</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <p>All fields are required.</p>

    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <div class="row">
            <?= $stickyForm->renderInput($formConfig["first_name"], "col-md-6") ?>
            <?= $stickyForm->renderInput($formConfig["last_name"], "col-md-6") ?>
        </div>

        <div class="row mt-3">
            <?= $stickyForm->renderInput($formConfig["email"], "col-md-4") ?>
            <?= $stickyForm->renderPassword($formConfig["password"], "col-md-4") ?>
            <?= $stickyForm->renderPassword($formConfig["confirm_password"], "col-md-4") ?>
        </div>

        <div class="mt-3">
            <input type="submit" name="submit" value="Register" class="btn btn-primary">
        </div>
    </form>

    <div class="mt-4">
        <?php if (is_array($records) && count($records) > 0): ?>
            <table class="table table-bordered">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
                <?php foreach ($records as $row): ?>
                    <tr>
                        <td><?= $row['first_name'] ?></td>
                        <td><?= $row['last_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['password'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No records to display.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>