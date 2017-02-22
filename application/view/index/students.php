<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-3">
        <div class="panel panel-primary">
            <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-9">
        <h3 style="margin-top: 0px;">All Students</h3>
        <?php if (isset($this->students)) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Current Year</th>
                        <th>Branch</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->students as $student) { ?>
                        <tr>
                            <td><?= $student->name ?></td>
                            <td><?= $student->current_year ?></td>
                            <td><?= $student->branch ?></td>
                            <td><?= $student->mobile_number ?></td>
                            <td><?= $student->email ?></td>
                            <td><?php if ($student->status == 1) { ?> <span class="label label-success">Active</span> <?php } else { ?> <span class="label label-danger">Inactive</span><?php } ?></td>
                            <td><a href="<?php echo Config::get('URL'); ?>index/editDetails/<?php echo $student->id; ?>" class="btn btn-warning" ><span class="glyphicon glyphicon-edit"></span></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>

    </div>
