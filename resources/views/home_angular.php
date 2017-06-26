<!DOCTYPE html>
<html ng-app="virtualExpoApp" lang="<?=app()->getLocale();?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?=csrf_token();?>">

    <title>Virtual Expo</title>
    

    <!-- Styles -->
    <link href="<?=asset('css/app.css'); ?>" rel="stylesheet">
    <link href="<?=asset('css/style.css'); ?>" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="<?=url('/'); ?>">
                        Virtual Expo
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->

                        <?php if(Auth::guest()): ?>
                            <li><a href="<?=route('login')?>">Login</a></li>
                            <li><a href="<?=route('register')?>">Register</a></li>
                        <?php else:?>





                            <li class="dropdown" uib-dropdown is-open="status.isopen">
                                <a href="#" is-open="status.isopen" uib-dropdown-toggle ng-disabled="disabled" aria-expanded="false">
                                    <?=Auth::user()->name?> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" uib-dropdown-menu role="menu">
                                    <li>
                                        <a href="<?=route('logout')?>"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>     
                                        <form id="logout-form" action="<?=route('logout')?>" method="POST" style="display: none;">
                                        <?=csrf_field()?>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
    <div ng-view>

    </div>

</div>



<!-- Angular scripts -->
<script src="<?=asset('app/bower_components/angular/angular.min.js')?>"></script>



<script src="<?=asset('app/bower_components/angular-bootstrap/ui-bootstrap.min.js')?>"></script>    
<script src="<?=asset('app/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js')?>"></script>
<script src="<?=asset('app/bower_components/angular-route/angular-route.min.js')?>"></script>


<!-- Google Maps scripts -->
<script src="<?=asset('app/bower_components/lodash/lodash.js')?>"></script>
<script src="<?=asset('app/bower_components/angular-simple-logger/dist/angular-simple-logger.min.js')?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAuMYvgGhGXf8WI7YEp25CIT0UGqkR5sGQ" async="" defer="defer" type="text/javascript"></script>
<script src="<?=asset('app/bower_components/angular-google-maps/dist/angular-google-maps.min.js')?>"></script>


<!-- Angular main module -->
<script src="<?=asset('app/app.js')?>"></script>
<!-- Angular services -->
<script src="<?=asset('app/services/current-user.js')?>"></script>
<script src="<?=asset('app/services/file-upload.js')?>"></script>

<!-- Angular controllers -->
<script src="<?=asset('app/controllers/home-controller.js')?>"></script>
<script src="<?=asset('app/controllers/event-controller.js')?>"></script>

<!-- Modals -->
<script src="<?=asset('app/controllers/email-modal-controller.js')?>"></script>
<script src="<?=asset('app/controllers/stand-modal-controller.js')?>"></script>
<script src="<?=asset('app/controllers/reservation-modal-controller.js')?>"></script>


<!-- Angular directives -->
<script src="<?=asset('app/directives/modal-directives.js')?>"></script>






</body>
</html>
