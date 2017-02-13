<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-3">
        <div class="panel panel-primary">
            <ul class="list-group">
                <li class="list-group-item"><a href="<?= Config::get("URL") ?>index/books">Books List</a></li>
                <li class="list-group-item"><a href="<?= Config::get("URL") ?>index/addbook">Add Books</a></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-9">
        <?php if (isset($this->books)) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ISBN</th>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Department</th>
                        <th>Tags</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->books as $book) { ?>
                        <tr>
                            <td><?= $book->id ?></td>
                            <td><?= $book->isbn ?></td>
                            <td><?= $book->name ?></td>
                            <td><?= $book->author ?></td>
                            <td><?= $book->publisher ?></td>
                            <td><?= $book->department ?></td>
                            <td><?= $book->tags ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>

        <?php if (isset($this->addBook)) { ?>
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
