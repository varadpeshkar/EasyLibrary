<div class="container">
    <div class="row">

        <?php
        $this->renderFeedbackMessages();
        if (isset($_GET['renewed'])) {
            $approved = $_GET['renewed'];
            if ($approved == "true") {
                ?>
                <script type="text/javascript">alert("Book renewed"); window.location = "issuedBooks"</script>
                <?php
            } else {
                ?>
                <script type="text/javascript">alert("Book Renew Failed"); window.location = "issuedBooks"</script>
                <?php
            }
        }

        if (isset($_GET['returned'])) {
            $approved = $_GET['returned'];
            if ($approved == "true") {
                ?>
                <script type="text/javascript">alert("Book returned"); window.location = "issuedBooks"</script>
                <?php
            } else {
                ?>
                <script type="text/javascript">alert("Book return failed"); window.location = "issuedBooks"</script>
                <?php
            }
        }
        ?>
        <div class="col-lg-2">
            <div class="panel panel-primary">
                <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="panel panel-info">
                <div class="panel-heading">Issued Books</div>
                <div class="panel-body">
                    <?php if (isset($this->requests) && sizeof($this->requests) > 0) { ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th>Book Name</th>
                                    <th>Student Name</th>
                                    <th>Student Email</th>
                                    <th>Student Year</th>
                                    <th>Issue Date</th>
                                    <th>Expiry Date</th>
                                    <th>Renew</th>
                                    <th>Return</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->requests as $request) { ?>
                                    <tr>
                                        <td><?= $request->book_isbn ?></td>
                                        <td><?= $request->book_name ?></td>
                                        <td><?= $request->student_name ?></td>
                                        <td><?= $request->student_email ?></td>
                                        <td><?= $request->student_year ?></td>
                                        <td><?= $request->issue_date ?></td>
                                        <td><?= $request->expiry_date ?></td>
                                        <td><a href="<?php echo Config::get('URL'); ?>index/renewBook/<?php echo $request->id; ?>" class="btn btn-success" ><span class="glyphicon glyphicon-refresh"></span></a></td>
                                        <td><a href="<?php echo Config::get('URL'); ?>index/returnBook/<?php echo $request->id; ?>" class="btn btn-danger" ><span class="glyphicon glyphicon-repeat"></span></a>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <h4 style="margin-top: 0px;">No Issued Books</h4>
                    <?php } ?>

                </div>
            </div>
        </div>