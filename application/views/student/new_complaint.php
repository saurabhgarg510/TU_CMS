<!-- Main -->
<section id="main" class="container small">
    <header>
        <h2>New complaint</h2>
    </header>
    <ul class="actions" style="text-align:center">
        <?php
        foreach ($category as $val) {
            if ($val == $title)
                continue;
            ?>
            <li><input type="button" style = "width: 200px" class="special" onClick="changeRC()" value="<?php echo $val; ?>"/></li>
            <?php
        }
        ?>
    </ul>
</section>
<section class="container small">
    <div class="box">

        <form method="post" action="<?php echo base_url(); ?>index.php/student/check" name="complaint" id="complaint">
            <div id="type"><h3>Electricity</h3>
                <input type="hidden" name="type" value="Electricity"/>
            </div>

            <div id="room_cluster" class="row uniform half collapse-at-2">
                <div class="6u">
                    <input type="radio" id="room" name="level" value="room">
                    <label for="room">Room</label>
                </div>
                <div class="6u">
                    <input type="radio" id="cluster" name="level" checked="true"  value="cluster">
                    <label for="cluster">Cluster</label>
                </div>

            </div>
            <div class="row uniform half">
                <div class="12u">
                    <textarea maxlength="60" name="message" id="message" placeholder="Type your complaint here..." rows="4" required onKeyDown="limitText(this.form.message, this.form.countdown, 60);" onKeyUp="limitText(this.form.message, this.form.countdown, 60);" style="resize:none"></textarea>
                    <input type="hidden" name="countdown" value="60">
                    <div id ="count" name="count">(Maximum characters: 60) You have 60 characters left.</div>
                </div>
            </div>
            <div class="row uniform">
                <div class="12u">
                    <ul class="actions align-center">
                        <li><input type="submit" value="Submit" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>

</section>
<script src="<?php echo base_url(); ?>/public/js/student.js"></script>