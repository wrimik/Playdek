<?php
include 'parts/no-header.php';
?>

<div class="container-fluid primary">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 col-xs-12">
            <div class="col-xs-12 np">
                <div class="card">
                    <h1>PLAYDEK ADMIN</h1>
                    <form role="form" method="post" action="process/login.php">
                        <div class="form-group">
                            <label>USERNAME</label>
                            <input class="form-control" type="text" name="username"/>
                        </div>
                        <div class="form-group">
                            <label>PASSWORD</label>
                            <input class="form-control" type="password" name="password"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>