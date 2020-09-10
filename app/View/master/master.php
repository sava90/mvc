<!DOCTYPE html>
<html lang="en-US">
    <head>
        <!--[if lt IE 9]>
        <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <title><?= @$pageTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= @$pageMetas ?>
        <link type="text/css" rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <div class="wrapper">
            <header class="header">
                <nav>
                    <ul>
                        <li><a href="/">Main</a></li>
                        <?php if ($view_loggedIn): ?>
                            <li><a href="/account/settings">My Settings</a></li>
                            <li class="last"><a href="/account/logout">Sign out</a></li>
                        <?php else: ?>
                            <li class="last">
                                <ul>
                                    <li><a href="/account/signin">Log in</a></li>
                                    <li><a href="/account/signup">Sign up</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </header>
            <?= @$pageContent ?>
        </div>
        <footer class="footer">
            <p>&copy; <?php echo date('Y'); ?>, All Rights Reserved</p>
        </footer>
        <script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="/js/script.js"></script>
    </body>
</html>
