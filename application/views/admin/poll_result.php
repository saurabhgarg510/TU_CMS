<section id="main" class="container" >
    <header>
        <h3 style="margin-bottom:0px;">Poll Results</h3>
    </header>
    <div class="box">
        <?php
        foreach ($query as $ro) {
            ?>
            <div class="poll_yes paddingb5"><h2 color="red"><?= $ro['ques']; ?>?</h2></div>
            <div class="poll_yes floatL paddingb5"><?= $ro['op1']; ?></div>
            <div class="paddingb5 floatL">
                <img src="<?php echo base_url(); ?>public/images/option.gif"
                     width='<?php echo(100 * round($ro['poll_c1'] / ($ro['pollsum']), 2)); ?>'
                     height='10'>
            </div>
            <div class="poll_percent floatR paddingb5"><?php echo(100 * round($ro['poll_c1'] / ($ro['pollsum']), 2)); ?>%</div>
            <div class="poll_yes floatL paddingb5"><?= $ro['op2']; ?></div>
            <img src="<?php echo base_url(); ?>public/images/option.gif"
                 width='<?php echo(100 * round($ro['poll_c2'] / ($ro['pollsum']), 2)); ?>'
                 height='10'>
            <div class="poll_percent floatR paddingb5"><?php echo(100 * round($ro['poll_c2'] / ($ro['pollsum']), 2)); ?>%</div>
            <?php if ($ro['op3'] != 'NULL') { ?>
                <div class="poll_yes floatL paddingb5"><?= $ro['op3']; ?></div> 
                <img src="<?php echo base_url(); ?>public/images/option.gif"
                     width='<?php echo(100 * round($ro['poll_c3'] / ($ro['pollsum']), 2)); ?>'
                     height='10'>
                <div class="poll_percent floatR paddingb5"><?php echo(100 * round($ro['poll_c3'] / ($ro['pollsum']), 2)); ?>%</div><?php } ?>
            <?php if ($ro['op4'] != 'NULL') { ?>
                <div class="poll_yes floatL paddingb5"><?= $ro['op4']; ?></div>
                <img src="<?php echo base_url(); ?>public/images/option.gif"
                     width='<?php echo(100 * round($ro['poll_c4'] / ($ro['pollsum']), 2)); ?>'
                     height='10'>
                <div class="poll_percent floatR paddingb5"><?php echo(100 * round($ro['poll_c4'] / ($ro['pollsum']), 2)); ?>%</div><?php } ?>

            <div class="cl"></div>
        <?php }
        ?>
    </div>
</section>