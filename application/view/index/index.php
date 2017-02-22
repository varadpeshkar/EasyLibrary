<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-3">
        <div class="panel panel-primary">
                <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-9">
        <?php if (isset($this->books)) { ?>
        <h3 style="margin-top: 0px;">All Books</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Department</th>
                        <th>Tags</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->books as $book) { ?>
                        <tr>
                            <td><?= $book->isbn ?></td>
                            <td><?= $book->name ?></td>
                            <td><?= $book->author ?></td>
                            <td><?= $book->publisher ?></td>
                            <td><?= $book->department ?></td>
                            <td><?= $book->tags ?></td>
                            <td><a href="<?php echo Config::get('URL'); ?>index/bookDetails/<?php echo $book->id; ?>" class="btn btn-success" ><span class="glyphicon glyphicon-eye-open"></span></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>

        <?php if (isset($this->addBook)) { ?>
        <a href="<?= Config::get("URL") ?>index/addBooksBulk" class="btn btn-success pull-right">Import Excel</a>
        <br/>
        <form class="form-horizontal" method="POST" action="<?= Config::get("URL") ?>index/addbook_action">
                <fieldset>

                    <!-- Form Name -->
          
                    <legend>Add Book</legend>
                    
                    

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">Book</label>  
                        <div class="col-md-4">
                            <input id="textinput" name="book_name" type="text" placeholder="name" class="form-control input-md" required="">
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
                    
                    <legend>Book Location</legend>
                    
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
