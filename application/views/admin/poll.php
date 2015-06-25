<section id="main" class="container small" >
    <header>
        <h3 style="margin-bottom:0px;">Add a new poll</h3>
        <?php
        if (isset($_SESSION['stmt'])) {
            echo "<p style=\"margin-bottom:0px;\">Category Deleted Successfully! </p>";
        }
        ?>
    </header>
    <div class="box">

        <form action="<?php echo base_url(); ?>index.php/admin/pollindex" method="post">
            <input type="text" name="ques" placeholder="Enter the question here..."><br>
            <input type="text" name="op1" placeholder="Option 1: "><br>
            <input type="text" name="op2" placeholder="Option 2: "><br>
            <input type="text" name="op3" placeholder="Option 3: "><br>
            <input type="text" name="op4" placeholder="Option 4: "><br>
            <input type="submit">
        </form>
    </div>
</section>