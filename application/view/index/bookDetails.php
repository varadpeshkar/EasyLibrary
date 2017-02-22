<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-3">
        <div class="panel panel-primary">
            <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-9">

        <h3>Book Details</h3>

        <?php if (isset($this->book)) { ?>

            <table class="table table-bordered">


                <tr>
                    <th class="active">
                        ISBN
                    </th>
                    <td >
                        <?php echo $this->book->isbn; ?>
                    </td>
                </tr>

                <tr>
                    <th class="active">
                        Name
                    </th>
                    <td >
                        <?php echo $this->book->name; ?>
                    </td>
                </tr>

                <tr>
                    <th class="active">
                        Author
                    </th>
                    <td >
                        <?php echo $this->book->author; ?>
                    </td>
                </tr>

                <tr>
                    <th class="active">
                        Publisher
                    </th>
                    <td >
                        <?php echo $this->book->publisher; ?>
                    </td>
                </tr>


                <tr>
                    <th class="active">
                        Department
                    </th>
                    <td >
                        <?php echo $this->book->department; ?>
                    </td>
                </tr>

                <tr>
                    <th class="active">
                        Location <br/>(Sec/Shelf/Row/Col)
                    </th>
                    <td >
                        <?php echo $this->book->location->section; ?>/<?php echo $this->book->location->shelf; ?>/<?php echo $this->book->location->row; ?>/<?php echo $this->book->location->column1; ?>
                    </td>
                </tr>

                <tr>
                    <th class="active">
                        Current Count
                    </th>
                    <td >
                        <?php echo $this->book->location->current_count; ?>
                    </td>
                </tr>



            </table>

        <?php } ?>


    </div>
</div>