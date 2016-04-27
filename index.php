<?php
include 'class/dbc.php';
include 'class/game.php';
include 'class/article.php';
include 'class/forum.php';

$a = new Article();
$news = $a->getArticles('news', 5);
$press = $a->getArticles('press', 5);
$game = new Game();
$forum = new Forum();

include 'parts/blog-posts.php';
include 'parts/header.php';
//$banners = $game->getBanners();
//include 'parts/carousel.php'; 
?>
<!--<link rel="stylesheet" type="text/css" href="css/home.css"/>-->
<script type="text/javascript">
    function newsCtrl($scope) {
        $scope.news = <?php echo json($news); ?>
    }
    function pressCtrl($scope) {
        $scope.press = <?php echo json($press); ?>
    }
    function blogCtrl($scope) {
        $scope.posts = <?php echo json($blog); ?>;
    }
    function forumCtrl($scope) {
        $scope.links = <?php echo json($forum->getLinks(6)); ?>;
    }
</script>

<div id="jump-to" class="hidden-xs">
    <div class="container-fluid">
        <div class="jt-container">
            <a href="#who-is-playdek">Who Is Playdek</a>
            <a href="#what-we-do">What We Do</a>
            <a href="#mber">The Future Is mBer</a>
            <a href="#community">In The Community</a>
            <a href="#presses">Hot Off The Presses</a>
        </div>
    </div>
</div>

<div class="stripe big-logo">
    <img src="images/big-logo.jpg"/>
</div>
<div id="who-is-playdek" class="stripe">
    <div  class="container-fluid">
        <div id="who-is-title" class="col-sm-4 col-xs-12">
            WHO IS
            PLAYDEK?
        </div>
        <div class="col-sm-8 col-xs-12">
            <div class="card">
                <p>
                    Founded in 2011, we have been making big waves in the mobile gaming realm by becoming the leading developer for digital board and card games.
                </p>
                <p>
                    Taking the next step we are preparing to revitalize the way online games are played with our cross-platform technology, connecting players with one another across multiple platforms allowing friends to play together regardless of the device they are playing on.
                </p>
                <p>
                    The path is clear, and together with you we are ready to start building the future of online gaming.
                </p>
            </div>
        </div>
    </div>
</div>
<div id="what-we-do" class="stripe  linen">
    <h2 class="center white stripe-title">WHAT WE DO</h2>
    <div class="center white aside">
        <p>
            We have made it our goal to share our passion and love for games of all types with the world. 
        </p>
    </div>
</div>



<!--     UNSUNG STORY -->
<div id="unsung-story" class="stripe featured-game">
    <div class="container-fluid">
        <div class="col-xs-12 card">
            <h2>UNSUNG STORY: TALE OF THE GUARDIANS</h2>
            <div class="col-xs-5 video np">
                <iframe width="100%"  height="250" src="https://www.kickstarter.com/projects/482445197/unsung-story-tale-of-the-guardians/widget/video.html" frameborder="0" scrolling="no"> </iframe>
            </div>
            <div class="col-xs-7">
                <p>
                    <b>COMING SOON</b>
                </p>
                <p>
                    Introducing the evolution of tactical RPG games brought 
                    to you by some of the greatest minds in the gaming industry. 
                    An exciting new story of loyalty, betrayal, jealousy, and 
                    determination to unify a land torn apart with conflict.
                </p>
                <p>
                    <a href="#" class="btn btn-primary pull-right">
                        COMING SOON
                    </a>
<!--                    <a href="unsung-story.php" class="btn btn-primary pull-right">
                        READ ON &#9658;
                    </a>-->
                    <a class="btn  btn-info pull-right" href="https://www.kickstarter.com/projects/482445197/unsung-story-tale-of-the-guardians" >
                        VIEW THE KICKSTARTER &#9658;
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
<!--     END UNSUNG STORY -->



<!--    TWILIGHT STRUGGLE -->
<div id="twilight-struggle" class="stripe featured-game">
    <div class="container-fluid">
        <div class="col-xs-12 card">        
            <h2>TWILIGHT STRUGGLE</h2>
            <div class="col-xs-12 col-sm-5 video np">
                 <iframe width="100%" height="250" src="https://www.kickstarter.com/projects/559431060/twilight-struggle-digital-edition/widget/video.html" frameborder="0" scrolling="no"> </iframe>
            </div>
            <div class="col-xs-12 col-sm-7">
                <p>
                    <b>COMING SOON</b>
                </p>
                <p>
                   Playdek has teamed up with GMT to bring one of the highest 
                   rated board games of all time to the digital world. Relive 
                   the Cold War like never before and change the path of history.
                </p>
                <p>
                    <a href="#" class="btn btn-primary pull-right">
                        COMING SOON
                    </a>
<!--                    <a href="twilight-struggle.php" class="btn btn-primary pull-right">
                        READ ON &#9658;
                    </a>-->
                    <a class="btn  btn-info pull-right" href="https://www.kickstarter.com/projects/559431060/twilight-struggle-digital-edition" >
                        VIEW THE KICKSTARTER &#9658;
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
<!--     TWILIGHT STRUGGLE-->



<!--    ASCENSION -->
<div id="twilight-struggle" class="stripe featured-game">
    <div class="container-fluid">
        <div class="col-xs-12 card">        
            <h2>ASCENSION</h2>
            <div class="col-xs-12 col-sm-5 video np">
                 <iframe width="100%" height="250" src="https://www.kickstarter.com/projects/559431060/twilight-struggle-digital-edition/widget/video.html" frameborder="0" scrolling="no"> </iframe>
            </div>
            <div class="col-xs-12 col-sm-7">
                <p>
                    <b>COMING SOON</b>
                </p>
                <p>
                   ASCENSION content to go here
                </p>
                <p>
                    <a href="#" class="btn btn-primary pull-right">
                        COMING SOON
                    </a>
<!--                    <a href="twilight-struggle.php" class="btn btn-primary pull-right">
                        READ ON &#9658;
                    </a>-->
                    <a class="btn  btn-info pull-right" href="https://www.kickstarter.com/projects/559431060/twilight-struggle-digital-edition" >
                        VIEW THE KICKSTARTER &#9658;
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
<!--    END  ASCENSION-->



<!--    LOW -->
<div id="twilight-struggle" class="stripe featured-game">
    <div class="container-fluid">
        <div class="col-xs-12 card">        
            <h2>LOW</h2>
            <div class="col-xs-12 col-sm-5 video np">
                 <iframe width="100%" height="250" src="https://www.kickstarter.com/projects/559431060/twilight-struggle-digital-edition/widget/video.html" frameborder="0" scrolling="no"> </iframe>
            </div>
            <div class="col-xs-12 col-sm-7">
                <p>
                    <b>COMING SOON</b>
                </p>
                <p>
                   LOW content to go here
                </p>
                <p>
                <a href="#" class="btn btn-primary pull-right">
                    COMING SOON
                </a>
<!--                    <a href="twilight-struggle.php" class="btn btn-primary pull-right">
                        READ ON &#9658;
                    </a>-->
                    <a class="btn  btn-info pull-right" href="https://www.kickstarter.com/projects/559431060/twilight-struggle-digital-edition" >
                        VIEW THE KICKSTARTER &#9658;
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
<!--     END LOW-->


<!--    MBER    -->
<div class="stripe" id="mber">
    <div class="container-fluid primary">
        <div class="col-sm-4">
            <img src="images/mber.png" id="mber-logo"/>
        </div>
        <div class="col-sm-8">
            <p>
            <h2 class="white">THE FUTURE</h3>
                </p>
                <p>
                    The future of online gaming is here now with mBer. 
                    Cross-platform connectivity that allows you to play and 
                    chat with your friends regardless of the device you are 
                    on or game you are playing, built in organized game play 
                    system to participate in tournaments with others across 
                    the globe for bragging rights, and a multitude of games all 
                    at your finger tips. Online gaming never looked so good.
                </p>
        </div>
    </div>
</div>
<!--   END MBER    -->

<div id="community" class="stripe linen">
    <div class="container-fluid primary np">
        <h2 class="center white stripe-title">IN THE COMMUNITY</h2>
        <div class="col-sm-4">
            <div class="card">
                <h2>Facebook</h2>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                <div class="fb-activity" data-app-id="Playdek" data-site="playdekgames.com" data-action="likes, recommends" data-width="264" data-colorscheme="light" data-header="false"></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <h2>Twitter</h2>
                <a class="twitter-timeline" href="https://twitter.com/Playdek" data-widget-id="506501726602399744">Tweets by @Playdek</a>
                <script>!function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + "://platform.twitter.com/widgets.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, "script", "twitter-wjs");</script>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card" ng-controller="forumCtrl">
                <h2>From The Forums</h2>
                <a class="forum" ng-repeat="link in links" target="_blank" href="{{link.fl_url}}">{{link.fl_text}}</a>
            </div>
        </div>
    </div>
</div>

<div class="stripe" id="presses">
    <div class="container-fluid primary">
        <h2 class="center black stripe-title">HOT OFF THE PRESSES</h2>
        <div class='col-xs-12'>
            <div class="row np presses">
                <div class="col-sm-4 col-xs-12">
                    <div class="card" ng-controller='newsCtrl'>
                        <h2><img src="images/icon-news.png"/> BREAKING NEWS</h2>
                        <a ng-repeat='new in news' href="news.php?article={{new.a_id}}">{{new.a_short_title}}</a>
                    </div>
                    <a href="news-wire.php" class="btn btn-info pull-right">
                        VIEW ALL NEWS  &#9658;
                    </a>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="card" ng-controller='blogCtrl'>
                        <h2><img src="images/blog.jpg"/> DEVELOPER DIARY</h2>
                        <a ng-repeat='post in posts' href="{{post.link}}">{{post.title}}</a>
                    </div>
                    <a href="Blog/" class="btn btn-info pull-right">
                        VISIT THE BLOG  &#9658;
                    </a>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="card" ng-controller='pressCtrl'>
                        <h2><img src="images/press.jpg"/> PRESS RELEASES</h2>
                        <a ng-repeat='pres in press' href="press-release.php?id={{pres.a_id}}">{{pres.a_short_title}}</a>
                    </div>
                    <a href="press.php" class="btn btn-info pull-right">
                        VIEW PRESS RELEASES  &#9658;
                    </a>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php
include 'parts/footer.php';