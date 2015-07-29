<body class="landing">
    <!-- Banner -->
    <section id="banner">
        <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="position:absolute; top: 0; z-index: 20000; color: wheat;">
           <!-- Login with your registered email at the time of online allotment. Your password is the passkey from webkiosk.-->

        </marquee>

        <b><h2>Online Hostel J</h2></b><br>
        <p><font color="blue">
        <!-- Main Notice -->
        Logins are disabled and will start soon. 
        </font></p>
        <ul class="actions">
            <li><a href="<?php echo base_url(); ?>index.php/complaint/sign_in" class="button special">Sign In (For Complaints)</a>&nbsp &nbsp 
                <a href="http://tuckshop.onlinehostelj.in" class="button special" target="_blank">Hostel J Tuck Shop</a>&nbsp &nbsp
                <a class="fadeandscale_open button special">Whats New</a><br>
                <a href="http://book.onlinehostelj.in" class="button special">Online Hostel Allotment</a>&nbsp &nbsp 
                <a href="http://onlinehostelj.in/shared/" class="button special">Shared Room Allotment</a><br>                
            </li>
        </ul>            
    </section><br><br><br>
    <!-- Main -->
    <section id="main" class="container">
        <section class="box special">
            <header class="major">
                <h2>Everything&nbsp; at&nbsp; one&nbsp; place
                    </h2>
            </header>
            <span class="image newfeatured"><img src="<?php echo base_url(); ?>public/images/pic01.jpg" alt="" /></span>
        </section>
    </section>
    <div id="fadeandscale" style="">
            <div class="box">
                <div id="type">
                        <h3>What's New</h3>
                        <?php $str='
                        -> Improved User Interface :)<br>
                        -> More Secure than ever. :coolsmile:<br>
                        -> One password for all sub-domains. All logins will now have<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;same username and password. :cheese:<br>
                        -> Added Forgot Password functionality. :question:<br>
                        -> Performance Enhancements. Browse faster and better. :coolhmm:<br>
                        -> Bugs or Issues? Drop an email: saurabhgarg510@gmail.com 8-/' ; 
                        $str=  parse_smileys($str, base_url().'public/smileys');
                        echo $str;
                        ?>

                </div>
            </div>
    </div>
    <!-- Include jQuery Popup Overlay -->
    <script src="<?php echo base_url(); ?>public/js/jquery.popupoverlay.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize the plugin
            $('#fadeandscale').popup({
                transition: 'all 0.3s' //optional
            });
        });
    </script>