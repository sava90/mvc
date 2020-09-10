<?php

$pageTitle = 'Settings';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
    <main class="content">
        <h1>My Settings</h1>

        <div class="form-wrap auth">
            <form id="<?php echo $view_settingsForm->getName();?>" method="post" name="<?php echo $view_settingsForm->getName();?>" data-reset="false">
                <input type="hidden" name="<?php echo $view_settingsForm->getToken()->name?>" value="<?php echo $view_settingsForm->getToken()->value?>">
                <div class="field">
                    <label>First Name</label>
                    <input type="text" name="<?php echo $view_settingsForm->getName();?>_first_name" id="<?php echo $view_settingsForm->getName();?>_first_name" value="<?php echo $view_user->firstName ?>" required="required">
                    <div class="error"></div>
                </div>
                <div class="field">
                    <label>Last Name</label>
                    <input type="text" name="<?php echo $view_settingsForm->getName();?>_last_name" id="<?php echo $view_settingsForm->getName();?>_last_name" value="<?php echo $view_user->lastName ?>" required="required">
                    <div class="error"></div>
                </div>
                <div class="field">
                    <label>Subscribe</label>
                    <input type="checkbox" name="<?php echo $view_settingsForm->getName();?>_subscribe" id="<?php echo $view_settingsForm->getName();?>_subscribe" <?php if($view_user->subscribe): ?>checked="checked"<?php endif; ?>>
                    <div class="error"></div>
                </div>
                <input type="submit" value="Submit">
                <div class="field result">
                    <input type="hidden" name="<?php echo $view_settingsForm->getName();?>_result" id="<?php echo $view_settingsForm->getName();?>_result">
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