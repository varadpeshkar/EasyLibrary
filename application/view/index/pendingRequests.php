<div class="container">
    <div class="row">

        <?php
        $this->renderFeedbackMessages();
        if (isset($_GET['approved'])) {
            $approved = $_GET['approved'];
            if ($approved == "true") {
                ?>
                <script type="text/javascript">alert("Request approved"); window.location = "pendingRequests"</script>
                <?php
            } else {
                ?>
                <script type="text/javascript">alert("Request rejected due to insufficient books"); window.location = "pendingRequests"</script>
                <?php
            }
        }
        ?>
        <div class="col-lg-3">
            <div class="panel panel-primary">
                <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
            </div>
        </div>
        <div class="col-lg-9">
            <h3 style="margin-top: 0px;">Pending Requests</h3>
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
                            <th>Actions</th>
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
                                <td><a href="<?php echo Config::get('URL'); ?>index/approveBookRequest/<?php echo $request->id; ?>" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span></a></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <h4 style="margin-top: 0px;">No Pending Requests</h4>
            <?php } ?>

        </div>
