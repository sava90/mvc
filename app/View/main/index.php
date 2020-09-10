<?php

$pageTitle = 'Main';
$pageMetas = '<meta name="description" content="">';
$pageMetas .= '<meta name="keywords" content="">';

ob_start();
?>
    <main class="content">
        <h1>Main page</h1>
        <?php if($view_users): ?>
            <div class="table-wrap">
                <table class="table">
                    <colgroup>
                        <col width="1%">
                        <col width="20%">
                        <col width="1%">
                        <col width="*">
                        <col width="20%">
                        <col width="20%">
                        <col width="1%">
                    </colgroup>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Active</th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Subscribe</th>
                    </tr>
                    <?php foreach ($view_users as $user): ?>
                        <tr>
                            <td class="center"><?php echo $user->userId ?></td>
                            <td class="center"><?php echo $user->createDate ?></td>
                            <td class="center"><?php echo $user->active ? 'Yes' : 'No' ?></td>
                            <td><?php echo $user->email ?></td>
                            <td><?php echo $user->firstName ?></td>
                            <td><?php echo $user->lastName ?></td>
                            <td class="center"><?php echo $user->subscribe ? 'Yes' : 'No' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </main>
<?php

$pageContent = ob_get_contents();
ob_end_clean();

require_once(__DIR__.'/../master/master.php');
?>