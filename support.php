<?php
include 'class/dbc.php';
include 'class/game.php';
include 'class/article.php';

$article = new Article();
$ts = $article->getArticles('troubleshooting', false);
$features = $article->getArticles('features', false);

include 'parts/header.php';
?>
<script type='text/javascript' language='javascript'>

    function tsCtrl($scope) {
        $scope.ts = <?php echo json($ts); ?>;
    }
    function featuresCtrl($scope) {
        $scope.features = <?php echo json($features); ?>;
    }

</script>

<div class="container-fluid primary">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 np">
                <div class="card">
                    <h1>Support</h1>
                    <p>This page lists some of the common challenges our players 
                        have encountered and information about the underlying issues.
                        In most cases, solutions that we have found to work are
                        provided. If your issue is not listed or if the provided
                        remedies don&rsquo;t seem to help, please email: 
                        <a href="mailto:support@playdekgames.com">support@playdekgames.com</a>
                    </p>
                    <b>Please let us know:</b>
                    <ul>
                        <li>The game you are having issues with</li>
                        <li>The version number or the last time you updated the game</li>
                        <li>Your device type</li>
                        <li>The OS version you are running</li>
                        <li>The model number of your device</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class="col-xs-12" ng-controller='featuresCtrl'>
            <div class="col-xs-12 np">
                <div class="card">
                    <h2 class='tsToggle' data-text='Features'>Show Features</h2>
                    <div class=' ts-topic' ng-repeat='f in features'>
                        <h3>{{f.a_title}}</h3>
                        <div class='htmlsafe'>{{f.a_html}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class="col-xs-12" ng-controller='tsCtrl'>
            <div class="col-xs-12 np">
                <div class="card">
                    <h2 class='tsToggle' data-text='Troubleshooting'>Show Troubleshooting</h2>
                    <div class=' ts-topic' ng-repeat='t in ts'>
                        <h3>{{t.a_title}}</h3>
                        <div class='htmlsafe'>{{t.a_html}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'parts/footer.php';