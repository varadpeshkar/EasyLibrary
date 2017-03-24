<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-2">
        <div class="panel panel-primary">
            <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-info">
            <div class="panel-heading">Edit Book Details</div>
            <div class="panel-body">

                <?php if (isset($this->book) && $this->book != null) { ?>
                    <form class="form-horizontal" method="POST" action="<?= Config::get("URL") ?>index/editBook_action/<?php $this->book->id ?>">
                        <fieldset>

                            <!-- Form Name -->


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Book</label>  
                                <div class="col-md-4">
                                    <input id="textinput" value="<?php $this->book->name ?>" name="book_name" type="text" placeholder="name" class="form-control input-md" required="">
                                    <span class="help-block">Provide book name.</span>  
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Author</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="author_name" type="text" placeholder="name" class="form-control input-md" required="">
                                    <span class="help-block">Provide author name.</span>  
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Publisher</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="publisher_name" type="text" placeholder="name" class="form-control input-md" required="">
                                    <span class="help-block">Provide publisher name.</span>  
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Department</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="department_name" type="text" placeholder="name" class="form-control input-md" required="">
                                    <span class="help-block">Provide department name</span>  
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">ISBN</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="isbn_number" type="text" placeholder="isbn" class="form-control input-md">
                                    <span class="help-block">Provide isbn number</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Tags</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="tags" type="text" placeholder="electornics, signals, etc" class="form-control input-md">
                                    <span class="help-block">Provide Tags for searching</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Section</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="section" type="text" placeholder="section" class="form-control input-md">
                                    <span class="help-block">Provide section name</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Shelf</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="shelf" type="text" placeholder="A/B/C" class="form-control input-md">
                                    <span class="help-block">Provide shelf name</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Row Number</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="row" type="number" value="1" min="1" placeholder="" class="form-control input-md">
                                    <span class="help-block">Provide row number</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Column Number</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="column" value="1" type="number" min="1" placeholder="" class="form-control input-md">
                                    <span class="help-block">Provide column number</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Current Items</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="current_count" value="1" type="number" min="1" placeholder="" class="form-control input-md">
                                    <span class="help-block">Provide book count</span>  
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="singlebutton"></label>
                                <div class="col-md-4">
                                    <button id="singlebutton" name="add_book" type="submit" class="btn btn-warning">Add book</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
