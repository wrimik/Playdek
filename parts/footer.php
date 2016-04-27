<div class="footer">
    <div class="container-fluid">
        <div class='row'>
            <div class='col-sm-4 col-sm-6 sitemap'>
                <h4>SITEMAP</h4>
                <a href='index.php'>HOME</a>
                <a href='games.php'>GAMES</a>
                <a href='partners.php'>PARTNERS</a>
                <a href='press.php'>BUSINESS/PRESS RELATIONS</a>
                <a href='privacy-policy.php'>TERMS OF USE</a>
                <a href='support.php'>FEATURES AND SUPPORT</a>
                <a target="_blank" href="http://playdek.invisionzone.com/">FORUMS</a>

            </div>
            <div class='col-sm-5  col-xs-12 sitemap'>
                <h4>GAMES LIBRARY</h4>
                <ul class="col-xs-12" id="footer-games" ng-controller="gamesCtrl">
                    <li class="col-xs-6" ng-repeat='game in games | filter:{game_published:1}'>
                        <a href="game.php?game_id={{game.game_id}}">{{game.game_name}}</a>
                    </li>
                </ul>
            </div>
            <div class='col-sm-3 col-xs-8'>
                <!--<h4>WE&rsquo;RE HIRING!</h4>
                <a href='#' class='btn btn-big btn-primary'>APPLY TODAY &#9658;</a>
                -->
                <form accept-charset="UTF-8" action="https://madmimi.com/signups/subscribe/117063" id="mad_mimi_signup_form" method="post" target="_blank">
                    <input name="utf8" type="hidden" value="✓"/>
                    <input name="authenticity_token" type="hidden" value="5b7Mv4ueBmnFHcXqO3i/Vm2k6IpkW/vaueRzpf6Rct4="/>
                    <h2 class="small-caption">
                        <span class="glyphicon glyphicon-envelope"></span> MAILING LIST
                    </h2>
                    <input class='form-control' id="signup_email" name="signup[email]" type="text" data-required-field="This field is required" placeholder="you@example.com"/>
                    <input type="submit" class="submit btn btn-primary pull-right" value="SUBSCRIBE" id="webform_submit_button" data-default-text="Subscribe" data-submitting-text="Sending..." data-invalid-text="↑ You forgot some required fields" data-choose-list="↑ Choose a list"/>
                </form>
                <script type='text/javascript' src='js/mailing-list-form.js'></script>

            </div>
        </div>
        <div class='col-xs-12'>
            <ul class="nav navbar-nav social">
                <li><a href="https://www.facebook.com/Playdek" target="_blank" class="fb"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/Playdek" class="tw" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://www.youtube.com/channel/UCsZhlS7_HENa93nEF9UewLg" class="yt" target="_blank"><i class="fa fa-youtube"></i></a></li>
            </ul>
        </div>
        <div class='col-xs-12 text-center'>
            Playdek, Inc. Copyright &copy; 2011 - <?php echo date('Y'); ?>. All Rights Reserved.
        </div>
    </div>
</div>
<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-53021857-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>