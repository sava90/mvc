<?php

$pageTitle = 'Verify Account';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
    <main class="content">
        <h1>Verify Account</h1>

        <?php if($view_result): ?>
            <p>Your Account is active! <a href="/account/signin">Log in</a></p>
        <?php else: ?>
            <p>Error</p>
        <?php endif; ?>
    </main>
<?php

$pageContent = ob_get_contents();
ob_end_clean();

require_once(__DIR__.'/../master/master.php');
?>