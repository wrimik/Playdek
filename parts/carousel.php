<script type="text/javascript" language="javascript">
    function bannersCtrl($scope) {
        $scope.banners = <?php echo json($banners); ?>;
    }
</script>

<div id="carousel" class="carousel slide" data-ride="carousel" ng-controller="bannersCtrl">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div ng-repeat="slide in banners" class="item {{slide.active}}">
            <img src="{{slide.src}}"/>
            <div class="carousel-caption">
                <a href='{{slide.b_url}}' class='btn btn-primary pull-right'>
                    VIEW  &#9658;
                </a>
            </div>
        </div>
    </div>
    <!-- Indicators -->
    <div id='carousel-controls' class="hidden-xs">
        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <ol class="carousel-indicators">
            <li ng-repeat="slide in banners"  data-slide-to="{{slide.key}}" data-target="#carousel" style="background-image: url('{{slide.src}}');" ></li>
        </ol>
        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>

</div>