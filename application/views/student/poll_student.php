<section id="main" class="container" >
    <header>
        <h3 style="margin-bottom:0px;">Active Polls</h3>
    </header>
    <div class="box">

        <?php foreach ($query as $ro) { ?>

            <div id="pollDisplay">
                <form><h3><?php echo $ro['ques']; ?>?</h3>
                    <input id="s" name="s" type="hidden" value="<?php echo htmlspecialchars($ro['id']); ?>">
                    <input type="radio" name="poll_option" id="1" class="poll_sys" value="1">
                    <label><?php
                        echo $ro['op1'];
                        ?></label>
                    <br>
                    <input type="radio" name="poll_option" id="2" class="poll_sys" value="2">
                    <label><?php
                        echo $ro['op2'];
                        ?></label>
                    <br>
                    <?php if ($ro['op3'] != 'NULL') { ?>
                        <input type="radio" name="poll_option" id="3" class="poll_sys" value="3">
                        <label><?php
                            echo $ro['op3'];
                            ?></label>
                        <br>
                    <?php } ?>
                    <?php if ($ro['op3'] != 'NULL') { ?>
                        <input type="radio" name="poll_option" id="4" class="poll_sys" value="4">
                        <label><?php
                            echo $ro['op4'];
                            ?></label>
                        <br>
                    <?php } ?>
                    <button class="button special" onclick="return submitPoll('<?php echo htmlspecialchars($ro['id']); ?>');" name="poll" >Submit Vote</button>
                </form>
            </div>
        <?php } ?>
    </div>
</section>

<script>
    function submitPoll(id) {
        var radios = $(".poll_sys");
        var checked = '';
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                var checked = 'checked';
            }
        }
        if (checked == '') {
            alert("Please select an Option to participate in the poll");
            radios[0].focus();
            return false;
        }

        var radiovalue = $('input[name="poll_option"]:checked').val();
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("pollDisplay").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "<?php echo base_url(); ?>index.php/student/pollx?vote=" + radiovalue + "&z=" + id, true);
        xmlhttp.send();
        return false;
    }
</script>