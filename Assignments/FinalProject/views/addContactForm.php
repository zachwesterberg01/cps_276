<?php
require_once 'controllers/addContactProc.php';

function init() {
    global $formConfig, $stickyForm, $acknowledgment;

    return <<<HTML
{$acknowledgment}
<h1>Add Contact</h1>
<p>Fields with * are required</p>
<form method="post" action="index.php?page=addContact">

    <div class="row">
        <div class="col-md-6">
            {$stickyForm->renderInput($formConfig['fname'], 'mb-3')}
        </div>
        <div class="col-md-6">
            {$stickyForm->renderInput($formConfig['lname'], 'mb-3')}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {$stickyForm->renderInput($formConfig['address'], 'mb-3')}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            {$stickyForm->renderInput($formConfig['city'], 'mb-3')}
        </div>
        <div class="col-md-4">
            {$stickyForm->renderSelect($formConfig['state'], 'mb-3')}
        </div>
        <div class="col-md-4">
            {$stickyForm->renderInput($formConfig['phone'], 'mb-3')}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
        </div>
        <div class="col-md-4">
            {$stickyForm->renderInput($formConfig['dob'], 'mb-3')}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {$stickyForm->renderRadio($formConfig['age'], 'mb-3', 'horizontal')}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {$stickyForm->renderCheckboxGroup($formConfig['contacts'], 'mb-3', 'horizontal')}
        </div>
    </div>

    <input type="submit" class="btn btn-primary" value="Add Contact">
</form>
HTML;
}
?>
