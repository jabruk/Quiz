<?php
namespace Quiz\View;

class Main extends Base
{

    public function container( array $data){
        
        ?>

            <div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">


                <!-- Sidebar -->
                <nav id="sidebar">
                    <!-- Sidebar Scroll Container -->
                    <div id="sidebar-scroll">
                        <!-- Sidebar Content -->
                        <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
                        <div class="sidebar-content">
                            <!-- Side Header -->
                            <div class="side-header side-content bg-white-op">
                                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                                <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                                    <i class="fa fa-times"></i>
                                </button>
                                <!-- Themes functionality initialized in App() -> uiHandleTheme() -->
                                <div class="btn-group pull-right">
                                    <button class="btn btn-link text-gray dropdown-toggle" data-toggle="dropdown" type="button">
                                        <i class="si si-drop"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right font-s13 sidebar-mini-hide">
                                        <li>
                                            <a data-toggle="theme" data-theme="default" tabindex="-1" href="javascript:void(0)">
                                                <i class="fa fa-circle text-default pull-right"></i> <span class="font-w600">Default</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="theme" data-theme="assets/css/themes/amethyst.min.css" tabindex="-1" href="javascript:void(0)">
                                                <i class="fa fa-circle text-amethyst pull-right"></i> <span class="font-w600">Amethyst</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="theme" data-theme="assets/css/themes/city.min.css" tabindex="-1" href="javascript:void(0)">
                                                <i class="fa fa-circle text-city pull-right"></i> <span class="font-w600">City</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="theme" data-theme="assets/css/themes/flat.min.css" tabindex="-1" href="javascript:void(0)">
                                                <i class="fa fa-circle text-flat pull-right"></i> <span class="font-w600">Flat</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="theme" data-theme="assets/css/themes/modern.min.css" tabindex="-1" href="javascript:void(0)">
                                                <i class="fa fa-circle text-modern pull-right"></i> <span class="font-w600">Modern</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="theme" data-theme="assets/css/themes/smooth.min.css" tabindex="-1" href="javascript:void(0)">
                                                <i class="fa fa-circle text-smooth pull-right"></i> <span class="font-w600">Smooth</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <a class="h5 text-white" href="index.html">
                                    <i class="fa fa-circle-o-notch text-primary"></i> <span class="h4 font-w600 sidebar-mini-hide">ne</span>
                                </a>
                            </div>
                            <!-- END Side Header -->

                            <!-- Side Content -->
                            <div class="side-content side-content-full">
                                <ul class="nav-main">
                                <?php if($_SESSION['auth']['privilege'] == 1): ?>
                                    <li>
                                        <a href="/users"><i class="si si-users"></i><span class="sidebar-mini-hide">Students</span></a>
                                    </li>
                                    <li>
                                        <a href="/tests"><i class="fa fa-instagram"></i><span class="sidebar-mini-hide">Tests</span></a>
                                    </li>
                                    <li>
                                        <a href="/studentresults"><i class="fa fa-table"></i><span class="sidebar-mini-hide">Student results</span></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if($_SESSION['auth']['privilege'] == 0): ?>
                                    <li>
                                        <a href="/tasks"><i class="si si-rocket"></i><span class="sidebar-mini-hide">Tasks</span></a>
                                    </li>
                                    <li>
                                        <a href="/results"><i class="fa fa-table"></i><span class="sidebar-mini-hide">Results</span></a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <!-- END Side Content -->
                        </div>
                        <!-- Sidebar Content -->
                    </div>
                    <!-- END Sidebar Scroll Container -->
                </nav>
                <!-- END Sidebar -->

                <!-- Header -->
                <header id="header-navbar" class="content-mini content-mini-full">
                    <!-- Header Navigation Right -->
                    <ul class="nav-header pull-right">
                        <li>
                            <div class="btn-group">
                                <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">
                                    <img src="/assets/img/avatars/avatar10.jpg" alt="Avatar">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-header">Profile</li>
                                    <li>
                                        <a tabindex="-1" href="base_pages_inbox.html">
                                            <i class="si si-envelope-open pull-right"></i>
                                            <span class="badge badge-primary pull-right">3</span>Inbox
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="base_pages_profile.html">
                                            <i class="si si-user pull-right"></i>
                                            <span class="badge badge-success pull-right">1</span>Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="javascript:void(0)">
                                            <i class="si si-settings pull-right"></i>Settings
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="dropdown-header">Actions</li>
                                    <li>
                                        <a tabindex="-1" href="base_pages_lock.html">
                                            <i class="si si-lock pull-right"></i>Lock Account
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="/logout">
                                            <i class="si si-logout pull-right"></i>Log out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                            <button class="btn btn-default" data-toggle="layout" data-action="side_overlay_toggle" type="button">
                                <i class="fa fa-tasks"></i>
                            </button>
                        </li>
                    </ul>
                    <!-- END Header Navigation Right -->

                    <!-- Header Navigation Left -->
                    <ul class="nav-header pull-left">
                        <li class="hidden-md hidden-lg">
                            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                            <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                                <i class="fa fa-navicon"></i>
                            </button>
                        </li>
                        <li class="hidden-xs hidden-sm">
                            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                            <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                        </li>
                        <li>
                            <!-- Opens the Apps modal found at the bottom of the page, before including JS code -->
                            <button class="btn btn-default pull-right" data-toggle="modal" data-target="#apps-modal" type="button">
                                <i class="si si-grid"></i>
                            </button>
                        </li>
                        <li class="visible-xs">
                            <!-- Toggle class helper (for .js-header-search below), functionality initialized in App() -> uiToggleClass() -->
                            <button class="btn btn-default" data-toggle="class-toggle" data-target=".js-header-search" data-class="header-search-xs-visible" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </li>
                        <li class="js-header-search header-search">
                            <form class="form-horizontal" action="base_pages_search.html" method="post">
                                <div class="form-material form-material-primary input-group remove-margin-t remove-margin-b">
                                    <input class="form-control" type="text" id="base-material-text" name="base-material-text" placeholder="Search..">
                                    <span class="input-group-addon"><i class="si si-magnifier"></i></span>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <!-- END Header Navigation Left -->
                </header>
                <!-- END Header -->

                <!-- Main Container -->
                <main id="main-container">
                    <!-- Page Header -->
                    <div class="content bg-gray-lighter">
                        <div class="row items-push">
                            <div class="col-sm-7">
                                <h1 class="page-heading">
                                    <?= $data['title'] ?? '' ?>
                                </h1>
                            </div>
                            <div class="col-sm-5 text-right hidden-xs">
                                <ol class="breadcrumb push-10-t">
                                    <li>Generic</li>
                                    <li><a class="link-effect" href="">Blank</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- END Page Header -->

                    <!-- Page Content -->
                    <div class="content">
                        <?php $this->content($data); ?>
                    </div>
                    <!-- END Page Content -->
                </main>
                <!-- END Main Container -->

                <!-- Footer -->
                <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
                    <div class="pull-right">
                        Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="http://goo.gl/vNS3I" target="_blank">pixelcave</a>
                    </div>
                    <div class="pull-left">
                        <a class="font-w600" href="http://goo.gl/6LF10W" target="_blank">OneUI 3.4</a> &copy; <span class="js-year-copy">2015</span>
                    </div>
                </footer>
                <!-- END Footer -->
            </div>

        <?php
    }
    protected function content(array $data){

    }

    protected function table(array $columns, array $data)
    {

        
        ?>

            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <?php foreach($columns as $column => $options): ?>
                            <th class="<?= $options['class'] ?>" style="<?= $options['style'] ?>"><?= $options['label'] ?></th>
                        <?php endforeach; ?>    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                        <tr>
                            <?php foreach($columns as $column => $options): ?>
                            
                                <?php if ($column !== 'table-action'): ?>
                                    <td class="<?= $options['class'] ?>"><?= $row[$column] ?></td>
                                <?php else : ?>
                                    <td class="<?= $options['class'] ?>">
                                        <div class="btn-group" role="group">
                                            <?php foreach($options['buttons'] as $button): ?>
                                                <a class="btn btn-default" href="<?= $button['url'] . '?id='  . $row['id']?>"><i class="<?= $button['icon'] ?>";></i></a>
                                            <?php endforeach; ?>    
                                        </div>
                                    </td>
                                <?php endif; ?>

                            <?php endforeach; ?> 
                        </tr>    
                    <?php endforeach; ?>  
                </tbody>                        
            </table>

        
        <?php
    }
}
?>