<?php
require_once(APPPATH . "libraries/functions.php");
?>

<script type="text/javascript" src="<?php echo base_url(); ?>/public/js/jquery.tablesorter.js"></script>
<script type="text/javascript">$(function() {
        $('#keywords').tablesorter({debug: true});
    });</script>
<script src="<?php echo base_url(); ?>/public/js/complaint_stu.js"></script>
<!-- Main -->
<section id="main" class="container large">
    <header>
        <h2>Complaints Status</h2>
    </header>
</section>
<div class="12u">
    <section class="box">
        <?php
        if ($status['counter'] != 0) {
            ?>
            <!---------------------------------------- POPUP start ------------------------->
            <div id="fadeandscale" >
                <table style="text-align:left">
                    <tr>
                        <th>Name</th>
                        <th>Complaint Id</th>
                        <th>Category</th>
                        <th>Room No</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th style="width: 25%">Details</th>
                    </tr>
                    <tr id="ajaxdata">
                    </tr>
                </table>
                <div class="box" style="padding: 15px;">
                    <div class="row uniform">
                        <div class="12u">
                            <center><h3>Remarks</h3></center>
                            <table style="text-align:center" id="getremark">
                                <?php // Loaded through ajax   ?>
                            </table>            
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <!---------------------------------------- POPUP end ------------------------->
            <div class="row">
                <div class="12u" >
                    <section class="box" id="print">
                        <h1 style="font-size:32px;text-align:center;margin-top:0px"> Complaints  </h1>
                        <div class="table-wrapper">
                            <table id="keywords" class="tablesorter" >
                                <thead>
                                    <tr>
                                        <th>Complaint Id</th>
                                        <th>Category</th>
                                        <th>Details</th>
                                        <th>Complaint Type</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($row as $val) { ?>
                                        <tr>
                                            <td><a class="fadeandscale_open" onclick=" show(<?php echo $val['comp_id']; ?>);"><?php echo $val['comp_id']; ?></a></td>
                                            <td><?php echo $val['category']; ?></td>
                                            <td><?php echo str_replace(array("\\r\\n", "\\r", "\\n"), "<br>", $val['details']); ?></td>
                                            <td><?php echo $val['comp_type']; ?></td>
                                            <td><?php echo format_date($val['comp_date']); ?></td>
                                            <td><?php
                                                if ($val['status'] == 'Pending') {
                                                    echo "<b style='color:blue'>" . $val['status'] . "</b>";
                                                } else if ($val['status'] == 'Complete') {
                                                    echo "<b style='color:green'>" . $val['status'] . "</b>";
                                                } else if ($val['status'] == 'Urgent') {
                                                    echo "<b style='color:red'>" . $val['status'] . "</b>";
                                                } else {
                                                    echo $val['status'];
                                                }
                                            }
                                        } else
                                            echo 'No Complaints added yet...';
                                        ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<!-- Include jQuery Popup Overlay -->
<script src="http://vast-engineering.github.io/jquery-popup-overlay/jquery.popupoverlay.js"></script>
<script>
    $(document).ready(function() {
        // Initialize the plugin
        $('#fadeandscale').popup();
        transition: 'all 0.3s'
    });
</script>