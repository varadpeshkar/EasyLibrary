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
                    <form class="form-horizontal" method="POST" action="<?= Config::get("URL") ?>index/editBook_action/<?php echo $this->book->id ?>">
                        <fieldset>

                            <!-- Form Name -->


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Book</label>  
                                <div class="col-md-4">
                                    <input id="textinput" value="<?php echo $this->book->name ?>" name="book_name" type="text" placeholder="name" class="form-control input-md" required="">
                                    <span class="help-block">Provide book name.</span>  
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Author</label>  
                                <div class="col-md-4">
                                    <input id="textinput" value="<?php echo $this->book->author ?>" name="author_name" type="text" placeholder="name" class="form-control input-md" required="">
                                    <span class="help-block">Provide author name.</span>  
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Publisher</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="publisher_name" value="<?php echo $this->book->publisher ?>" type="text" placeholder="name" class="form-control input-md" required="">
                                    <span class="help-block">Provide publisher name.</span>  
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Department</label>  
                                <div class="col-md-4">
                                    <select id="branch" name="department_name" class="form-control">
                                        <option value="Computer Engineering" <?php if ($this->book->department == 'Computer Engineering') { ?> selected="true" <?php } ?>>Computer Engineering</option>
                                        <option value="IT Engineering" <?php if ($this->book->department == 'IT Engineering') { ?> selected="true" <?php } ?>>IT Engineering</option>
                                        <option value="Mechanical Engineering" <?php if ($this->book->department == 'Mechanical Engineering') { ?> selected="true" <?php } ?>>Mechanical Engineering</option>
                                        <option value="Electrical Engineering" <?php if ($this->book->department == 'Electrical Engineering') { ?> selected="true" <?php } ?>>Electrical Engineering</option>
                                        <option value="Electronics Engineering"<?php if ($this->book->department == 'Electronics Engineering') { ?> selected="true" <?php } ?>>Electronics Engineering</option>
                                        <option value="Civil Engineering" <?php if ($this->book->department == 'Civil Engineering') { ?> selected="true" <?php } ?>>Civil Engineering</option>
                                    </select>
                                    <span class="help-block">Provide department name</span>  
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">ISBN</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="isbn_number" type="text" placeholder="isbn" value="<?php echo $this->book->isbn ?>" class="form-control input-md">
                                    <span class="help-block">Provide isbn number</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Tags</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="tags" type="text" placeholder="electornics, signals, etc" value="<?php echo $this->book->tags ?>" class="form-control input-md">
                                    <span class="help-block">Provide Tags for searching</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Section</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="section" type="text" placeholder="section" value="<?php echo $this->book->location->section ?>" class="form-control input-md">
                                    <span class="help-block">Provide section name</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Shelf</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="shelf" type="text" placeholder="A/B/C" value="<?php echo $this->book->location->shelf ?>"  class="form-control input-md">
                                    <span class="help-block">Provide shelf name</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Row Number</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="row" type="number" min="1" placeholder="" value="<?php echo $this->book->location->row ?>"  class="form-control input-md">
                                    <span class="help-block">Provide row number</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Column Number</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="column"  type="number" min="1" placeholder="" value="<?php echo $this->book->location->column1 ?>"  class="form-control input-md">
                                    <span class="help-block">Provide column number</span>  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Current Items</label>  
                                <div class="col-md-4">
                                    <input id="textinput" name="current_count" value="<?php echo $this->book->location->current_count ?>" type="number" min="1" placeholder="" class="form-control input-md">
                                    <span class="help-block">Provide book count</span>  
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="singlebutton"></label>
                                <div class="col-md-4">
                                    <button id="singlebutton" name="add_book" type="submit" class="btn btn-success">Update Details</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
