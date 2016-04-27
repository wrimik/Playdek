<?php
include 'class/dbc.php';
include 'class/game.php';
include 'parts/header.php';
?>

<script type="text/javascript">
    
    function partnerCtrl($scope){
        $scope.partners = [
            {
                url:"http://www.alderac.com",
                img:"images/partner_aeg.jpg"
            },
            {
                url:"http://www.arclight.co.jp/ag/index.php",
                img:"images/partner_arclight_games.jpg"
            },
            {
                url:"http://www.cryptozoic.com/",
                img:"images/partner_cryptozoic.jpg"
            },
            {
                url:"http://www.eaglegames.net/",
                img:"images/partner_eagle_games.jpg"
            },
            {
                url:"http://www.gmtgames.com/",
                img:"images/partner_gmt_games.jpg"
            },
            {
                url:"http://www.eaglegames.net/",
                img:"images/partner_gryphon_games.jpg"
            },
            {
                url:"http://lookout-games.de/",
                img:"images/partner_lookout.jpg"
            },
            {
                url:"http://www.looneylabs.com",
                img:"images/partner_looney_labs.jpg"
            },
            {
                url:"http://www.ludically.com/",
                img:"images/partner_ludically.jpg"
            },
            {
                url:"http://www.plaidhatgames.com/",
                img:"images/partner_plaidhat.jpg"
            },
            {
                url:"http://ascensiongame.com/",
                img:"images/partner_stoneblade.jpg"
            },
            {
                url:"http://company.wizards.com/",
                img:"images/partner_wizards.jpg"
            }
        ];
    }
</script>

<div class="container-fluid primary">
    <div class="row">
        <div class="col-xs-12" ng-controller="partnerCtrl">
            <div class="col-xs-12 col-sm-4" ng-repeat="partner in partners">
                <div class="card">
                    <a class="partner" href="{{partner.url}}" target="_blank">
                        <img src='{{partner.img}}'/>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'parts/footer.php';