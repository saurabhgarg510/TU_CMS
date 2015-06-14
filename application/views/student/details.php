<section class="container small">
    <div class="box">
        <div id="type">
            <center>
                <h2><?php
                    if ($status == 'SUCCESS')
                        echo 'Your complaint has been recorded successfully';
                    else if ($status == 'EXCEED')
                        echo 'You have exceeded your maximum complaint limit of 2/day. Please try again tomorrow';
                    //else { header('location: http://localhost/ci/index.php/student/home/'); die(); }
                    ?></h2>
                <ul class="actions" style="text-align:center">
                    <li><a href="<?php echo base_url(); ?>index.php/student/home" class="special">Click here </a> to go back</li>
                    <li><a href="<?php echo base_url(); ?>index.php/student/status" class="special">Click here </a> to view previous complaints</li>
                </ul>
            </center>
        </div>
    </div>
</section>
