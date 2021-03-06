<?php

$pageTitle = 'Sign Up';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
    <main class="content">
        <h1>Create your account</h1>
        <div class="form-wrap auth">
            <form id="<?php echo $view_registrationForm->getName();?>" method="post" name="<?php echo $view_registrationForm->getName();?>" data-reset="true">
                <input type="hidden" name="<?php echo $view_registrationForm->getToken()->name?>" value="<?php echo $view_registrationForm->getToken()->value?>">
                <div class="field">
                    <label>Email</label>
                    <input type="email" name="<?php echo $view_registrationForm->getName();?>_email" id="<?php echo $view_registrationForm->getName();?>_email" required="required">
                    <div class="error"></div>
                </div>
                <div class="field">
                    <label>Password</label>
                    <input type="password" name="<?php echo $view_registrationForm->getName();?>_password" id="<?php echo $view_registrationForm->getName();?>_password" required="required">
                    <div class="error"></div>
                </div>
                <div class="field">
                    <label>Confirm Password</label>
                    <input type="password" name="<?php echo $view_registrationForm->getName();?>_confirm_password" id="<?php echo $view_registrationForm->getName();?>_confirm_password" required="required">
                    <div class="error"></div>
                </div>
                <input type="submit" value="Submit">
                <div class="field result">
                    <input type="hidden" name="<?php echo $view_registrationForm->getName();?>_result" id="<?php echo $view_registrationForm->getName();?>_result">
                    <div class="error"></div>
                    <div class="success"></div>
                </div>
            </form>
        </div>
    </main>
<?php

$pageContent = ob_get_contents();
ob_end_clean();

require_once(__DIR__.'/../master/master.php');
?>