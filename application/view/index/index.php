<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-2">
        <div class="panel panel-primary">
            <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-10">
        <?php if (isset($this->books)) { ?>
            <div class="panel panel-info">
                <div class="panel-heading">All Books</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>Department</th>
                                <th>Tags</th>
                                <th>View Details</th>
                                <th>Edit</th>
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
                                    <td><a href="<?php echo Config::get('URL'); ?>index/editBookDetails/<?php echo $book->id; ?>" class="btn btn-warning" ><span class="glyphicon glyphicon-edit"></span></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php } ?>

        <?php if (isset($this->addBook)) { ?>
            <div class="panel panel-info">
                <div class="panel-heading">Add A Book <a href="<?= Config::get("URL") ?>index/addBooksBulk" style="margin: 0px; padding: 0" class="btn btn-inverse pull-right">Import Excel</a></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?= Config::get("URL") ?>index/addbook_action">
                        <fieldset>

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
                                    <select id="branch" name="department_name" class="form-control" required>
                                        <option value="Computer Engineering">Computer Engineering</option>
                                        <option value="IT Engineering">IT Engineering</option>
                                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                                        <option value="Electrical Engineering">Electrical Engineering</option>
                                        <option value="Electronics Engineering">Electronics Engineering</option>
                                        <option value="Civil Engineering">Civil Engineering</option>
                                    </select>
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
                                    <input id="textinput" name="tags" type="text" placeholder="fe,se,te,be,comp,it etc" class="form-control input-md">
                                    <span class="help-block">Provide Tags like branch, year Eg: fe,se,te,be</span>  
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
                </div>
            </div>
        <?php } ?>
    </div>
</div>
