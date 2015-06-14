<section class="container small">
    <div class="box">
        <div id="type">
            <center>
                <h2>Reset Password</h2>
                <form action="<?php echo base_url(); ?>index.php/complaint/updatePassword" method="post">
                    <input type="email" name="email" value="<?php echo $email; ?>" readonly><br>
                    <input type="password" name="pass" required placeholder="Enter your new password..."><br>
                    <input type="password" name="repass" required placeholder="Re-Enter your new password..."><br>
                    <input type="submit" class="special" value="Reset Password">
                </form>
            </center>
        </div>
    </div>
</section>

