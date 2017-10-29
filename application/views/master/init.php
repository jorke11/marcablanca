<script src="<?php echo base_url() ?>librerias/toastr/toastr.min.js"></script>
<link href="<?php echo base_url() ?>librerias/toastr/toastr.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id='myTabs'>
            <li role="presentation" class="active" id="tabList"><a href="#list" aria-controls="home" role="tab" data-toggle="tab">Manual</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="list">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo $this->load->view("master/form"); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>public/js/sistema/master.js"></script>