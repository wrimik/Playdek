<?php

include '../class/dbc.php';
include '../class/article.php';
$dbc = dbc::getInstance(false);
$article = new Article();
$get     = $article->dbc->cleanArray($_GET);
$a       = $article->getArticle($get['id'], $type);
$list    = $article->getArticles($type);
include 'parts/header.php';
?>
<script src="//cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script type='text/javascript' language='javascript'>
    
    function articleCtrl($scope){
        $scope.article = <?php echo json($a); ?>
    }
    function alistCtrl($scope){
        $scope.alist = <?php echo json($list); ?>
    }
    
</script>
 
<div class="container-fluid primary">
    <div class="row">
        <div class="col-sm-9 col-xs-12">
            <div class="card" >
                <form enctype="multipart/form-data" ng-controller='articleCtrl' role="form" method="post" action="process/article.php" class='{{article.a_type}}'>
                    <h1>{{article.edit_title}}</h1>

                    <input value="{{article.a_id}}" type="hidden" name="article_id"/>
                    <input value="{{article.a_type}}" type="hidden" name="type"/>
                    <div class="col-xs-8">
                        <div class="form-group">
                            <label>ARTICLE NAME</label>
                            <input name="title" value="{{article.a_title}}" class="form-control" type="text" />
                        </div>
                    </div>
                    <div class="col-xs-4" id='date'>
                        <div class="form-group">
                            <label>DATE</label>
                            <input name="date" value="{{article.a_date}}" class="form-control datepicker" type="text" />
                        </div>
                    </div>
                     <div class="col-xs-8">
                        <div class="form-group">
                            <label>UPDATE ARTICLE IMAGE <i></i></label>
                            <input name="img" class="form-control" type="file" />
                        </div>
                    </div>
                    <div class="col-xs-12" id='forward'>
                        <div class="form-group">
                            <label>Off-Site Forwarding Url</label>
                            <input name="forwarding_url" value="{{article.forwarding_url}}" class="form-control" type="text" placeholder='http://www.website.com/' />
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>STATUS</label><br/>
                            <label class="col-xs-6">
                                <input ng-model='article.a_published' type="radio" name="published" value="1"/>
                                Published
                            </label>
                            <label class="col-xs-6">
                                <input ng-model='article.a_published' type="radio" name="published" value="0"/>
                                Hidden
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>CONTENT</label>
                            <textarea class="ckeditor" name="content">{{article.a_html}}</textarea>
                        </div>
                    </div>
                    <div class="col-xs-12" id='preview'>
                        <div class="form-group">
                            <label>PREVIEW</label>
                            <textarea class="ckeditor" name="preview">{{article.a_preview}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-sm-3 col-xs-12">
            <div ng-controller='alistCtrl' class="card">
                <h2>Edit Articles</h2>
                <a ng-repeat='item in alist' href='{{item.edit_url}}'>{{item.a_title}}<br/></a>
            </div>
        </div>
    </div>
</div>
