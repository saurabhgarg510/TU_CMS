<div id="pollDisplay">
    <form><br>
        <input type="radio" name="poll_option" id="1" class="poll_sys" value="<?php echo htmlspecialchars($ans1); ?>">
        <label><?php
            echo $op1;
            ?></label>
        <br>
        <input type="radio" name="poll_option" id="2" class="poll_sys" value="<?php echo htmlspecialchars($ans2); ?>">
        <label><?php
            echo $op2;
            ?></label>
        <br>
        <?php if ($op3 != "") { ?>
            <input type="radio" name="poll_option" id="3" class="poll_sys" value="<?php echo htmlspecialchars($ans3); ?>">
            <label><?php
                echo $op3;
                ?></label>
            <br>
        <?php } ?>
        <?php if ($op4 != "") { ?>
            <input type="radio" name="poll_option" id="4" class="poll_sys" value="<?php echo htmlspecialchars($ans4); ?>">
            <label><?php
                echo $op4;
                ?></label>
            <br>
        <?php } ?>
        <input type="image" onclick="return submitPoll();" class="vote" src="submit.jpg" name="poll">
    </form>
</div>

<script>
    function submitPoll()
    {
        var radios = $(".poll_sys");
        var checked = '';
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                var checked = 'checked';
            }
        }
        if (checked === '') {
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
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                document.getElementById("pollDisplay").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "<?php echo base_url(); ?>index.php/admin/pollx?vote=" + radiovalue, true);
        xmlhttp.send();
        return false;
    }
</script>

