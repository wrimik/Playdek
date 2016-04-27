<!DOCTYPE html>
<html lang="en" ng-app>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Playdek Games</title>
        <link rel="icon" type="image/vnd.microsoft.icon" href="http://www.playdekgames.com/include/favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="http://www.playdekgames.com/include/favicon.ico" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"/>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="/css/fonts.css" />
        <link rel="stylesheet" type="text/css" href="/css/common.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular-sanitize.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!--[if lt IE 9]>
                        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                  <![endif]-->
        <script src='js/common.js' type='text/javascript' language='javascript' ></script>
        <script type='text/javascript' language='javascript' >
            angular.module('app', ['ngSanitize']);
            function gamesCtrl($scope){
                $scope.games = <?php echo json($games); ?>;
            }
            $(document).ready(function(){
                $('body.pending').removeClass('pending');
            });
        </script>
        
    </head>
    <body class="pending">
        <nav id="nav" class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/index.php"><img src="/images/logo-nav.jpg"/></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/index.php">HOME</a></li>
                        <li id="nav-show-games" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">GAMES <span class="caret"></span></a>
                        </li>
                        <li><a target="_blank" href="http://playdek.invisionzone.com/">FORUMS</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right social">
                        <li><a href="https://www.facebook.com/Playdek" class="fb"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/Playdek" class="tw"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCsZhlS7_HENa93nEF9UewLg" class="yt"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
            <div id="games-nav" ng-controller='gamesCtrl'>
                <div class="game-scroll gs-left">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </div>
                <div id="game-link-view-all">
                    <a href="/games.php"><span>VIEW ALL</span></a>
                </div>
                <div id="game-link-icons">
                    <div>
                        <div class="game-link" ng-repeat='game in games | filter:{game_published:1}'>
                            <a href="game.php?game_id={{game.game_id}}">
                                <img src="/uploads/game-icons/{{game.game_id}}.png"/>
                                <span class="hidden-sm hidden-xs">{{game.game_name}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="mobile-game-link-icons">
                    <a href="games.php"><span>VIEW ALL</span></a>
                    <a ng-repeat='game in games | filter:{game_published:1}' href="game.php?game_id={{game.game_id}}">
                        <img src="uploads/game-icons/{{game.game_id}}.png"/>
                        <span class="hidden-sm hidden-xs">{{game.game_name}}</span>
                    </a>
                </div>
                <div class="game-scroll gs-right">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </div>
            </div>
        </nav>
