<ul class="list-group">
    <ul class="list-group">
        <a class="text-info" href="<?php echo Config::get('URL') ?>"><li class="list-group-item sidemenu-home" style="padding: 8px 10px 8px 10px;"><span style="font-size:16px;" class="hidden-xs showopacity glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</li></a>
        <a class="text-info" href="<?php echo Config::get('URL') ?>index/pendingRequests"><li class="list-group-item sidemenu-home" style="padding: 8px 10px 8px 10px;"><span style="font-size:16px;" class="hidden-xs showopacity glyphicon glyphicon-tasks"></span>&nbsp;&nbsp;Pending Requests</li></a>
        <a class="text-info" href="<?php echo Config::get('URL') ?>index/issuedBooks"><li class="list-group-item sidemenu-home" style="padding: 8px 10px 8px 10px;"><span style="font-size:16px;" class="hidden-xs showopacity glyphicon glyphicon-tags"></span>&nbsp;&nbsp;Issued Books</li></a>
        <a class="text-info" href="<?php echo Config::get('URL') ?>index/books"><li class="list-group-item sidemenu-home" style="padding: 8px 10px 8px 10px;"><span style="font-size:16px;" class="hidden-xs showopacity glyphicon glyphicon-book"></span>&nbsp;&nbsp;All Books</li></a>
        <a class="text-info" href="<?php echo Config::get('URL') ?>index/addbook"><li class="list-group-item sidemenu-home" style="padding: 8px 10px 8px 10px;"><span style="font-size:16px;" class="hidden-xs showopacity glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Book</li></a>
        <a class="text-info" data-toggle="collapse" data-target="#list-dropdown"><li class="list-group-item sidemenu-lists" style="padding: 8px 10px 8px 10px;"></span><span style="font-size:16px;" class="hidden-xs showopacity glyphicon glyphicon-list"></span>&nbsp;&nbsp;Student Lists&nbsp;<span class="caret"></li></a>
        <ul id="list-dropdown" class="collapse">
            <a class="text-info" href="<?php echo Config::get("URL"); ?>index/students/All"><li class="list-group-item" style="padding: 8px 10px 8px 10px;"> All</li></a>
            <a class="text-info" href="<?php echo Config::get("URL"); ?>index/students/F.E"><li class="list-group-item" style="padding: 8px 10px 8px 10px;">F.E</li></a>
            <a class="text-info" href="<?php echo Config::get("URL"); ?>index/students/S.E"><li class="list-group-item" style="padding: 8px 10px 8px 10px;">S.E</li></a>
            <a class="text-info" href="<?php echo Config::get("URL"); ?>index/students/T.E"><li class="list-group-item" style="padding: 8px 10px 8px 10px;">T.E</li></a>
            <a class="text-info" href="<?php echo Config::get("URL"); ?>index/students/B.E"><li class="list-group-item" style="padding: 8px 10px 8px 10px;">B.E</li></a>
        </ul>
        <a class="text-info" href="<?php echo Config::get('URL') ?>index/addStudents"><li class="list-group-item sidemenu-home" style="padding: 8px 10px 8px 10px;"><span style="font-size:16px;" class="hidden-xs showopacity glyphicon glyphicon-user"></span>&nbsp;&nbsp;Add Students</li></a>
        <a class="text-info" href="<?php echo Config::get("URL"); ?>login/logout"><li class="list-group-item" style="padding: 8px 10px 8px 10px;"><span style="font-size:16px;" class="hidden-xs showopacity glyphicon glyphicon-off"></span>&nbsp;&nbsp;Logout</li></a>
    </ul>
</ul>
