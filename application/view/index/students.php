<div class="container">
    <?php $this->renderFeedbackMessages(); ?>
    <div class="col-lg-2">
        <div class="panel panel-primary">
            <?php require Config::get('PATH_VIEW') . 'index/menu.php' ?>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="panel panel-info">
            <div class="panel-heading"><?php echo $this->year; ?> Students</div>
            <div class="panel-body">
                <?php if (isset($this->students) && sizeof($this->students) > 0) { ?>
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
                                    <td><a href="<?php echo Config::get('URL'); ?>index/editStudent/<?php echo $student->id; ?>" class="btn btn-warning" ><span class="glyphicon glyphicon-edit"></span></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <h4 style="margin-top: 0px;" class="text-danger">No Students Present</h4>
                <?php } ?>

            </div>

        </div>

    </div>
