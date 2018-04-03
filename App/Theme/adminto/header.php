<?php
use Spell\Flash\Path;
use Spell\MVC\Flash\Route;

$home = Route::getRoot() . Path::combine(['acl', 'auth', 'dashboard'], '/')
?>
<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="<?php echo $home;?>" class="logo"><span>Admin <span>Sample</span></span></a>
            </div>
            <!-- End Logo container-->
                        
            <div class="menu-extras">
<?php require __DIR__ . DIRECTORY_SEPARATOR . 'top-right-menu.php'; ?>

                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>
<?php // */ ?>
        </div>
    </div>

    <div class="navbar-custom">
        <div class="container">
            <?php require __DIR__ . DIRECTORY_SEPARATOR . 'nav.php';?>
            
        </div>
    </div>
</header>
<!-- End Navigation Bar-->