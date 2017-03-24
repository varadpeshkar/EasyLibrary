<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-2">
        <div class="panel panel-primary">
            <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-10">



        
        <div class="col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading text-center" style="font-size: 18px">Total Pending</div>
                <div class="panel-body">
                    <h1 class="text-center text-danger " style="font-weight: bold"><?php echo $this->stats->pending; ?></h1>
                    <center><a href="<?php echo Config::get("URL"); ?>index/pendingRequests">View</a></center>
                </div>
            </div>    
        </div>

        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center" style="font-size: 18px">Total Issued</div>
                <div class="panel-body">
                    <h1 class="text-center text-success " style="font-weight: bold"><?php echo $this->stats->issued; ?></h1>
                    <center><a href="<?php echo Config::get("URL"); ?>index/pendingRequests">View</a></center>
                </div>
            </div>    
        </div>
        
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading text-center" style="font-size: 18px">Total Students</div>
                <div class="panel-body">
                    <h1 class="text-center text-primary" style="font-weight: bold"><?php echo $this->stats->students; ?></h1>
                    <center><a href="<?php echo Config::get("URL"); ?>/index/students">View</a></center>
                </div>
            </div>    
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading text-center" style="font-size: 18px">Total Books</div>
                <div class="panel-body">
                    <h1 class="text-center text-primary " style="font-weight: bold"><?php echo $this->stats->books; ?></h1>
                    <center><a href="<?php echo Config::get("URL"); ?>index/books">View</a></center>
                </div>
            </div>    
        </div>
    </div>
</div>

