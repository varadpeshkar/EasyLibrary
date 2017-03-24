<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-2">
        <div class="panel panel-primary">
            <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-info">
            <div class="panel-heading">Add Books Bulk <a href="<?= Config::get("URL") ?>index/downloadFormat" style="margin: 0; padding: 0;" class="btn btn-inverse pull-right">Download Format</a></div>
            <div class="panel-body">
                
                <br/>

                <form class="form-horizontal"   method="post" enctype="multipart/form-data" action="<?= Config::get("URL") ?>index/addBooksBulk_action">
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Import Excel File</legend>

                        <!-- File Button --> 
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            
                            <div class="col-md-4">
                                <input type="text" readonly="" class="form-control" placeholder="Browse...">
                                <input id="filebutton" name="books_excel" class="input-file" accept=".xlsx application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-exce" type="file">
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="submit"></label>
                            <div class="col-md-4">
                                <input type="submit" id="submit" name="submit" value="Upload" class="btn btn-success"/>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>

    </div>
</div>
