<body class="landing">

    <!-- Header -->
    <!-- Banner -->
    <section id="banner">
        <!--<marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="position:absolute; top: 0; z-index: 20000; color: blue; font-weight: bold;">
        Registrations for the hostel rooms allotment will start on <font color="red">Saturday (16 May, 2015).</font> For any query contact Saurabh (+91-9041544335) </marquee>-->

        <b><h2>Online Hostel J</h2></b><br>
        <p></p>
        <ul class="actions">
            <li><a href="<?php echo base_url(); ?>index.php/complaint/sign_in/" class="button special">Sign In (For Complaints)</a>&nbsp &nbsp 
                <a href="http://book.onlinehostelj.in" class="button special">Online Hostel Allotment</a>&nbsp &nbsp 
                <a href="http://onlinehostelj.in/shared/" class="button special">Shared Room Allotment</a><br>
                <a href="http://tuckshop.onlinehostelj.in" class="button special" target="_blank">Hostel J Tuck Shop</a>&nbsp &nbsp
                <a class="fadeandscale_open button special">Whats New</a>
            </li>

        </ul>            
    </section><br><br><br>
    <!-- Main -->
    <section id="main" class="container">

        <section class="box special">
            <header class="major">
                <h2>Introducing&nbsp; the&nbsp; new&nbsp; solution
                    <br />
                    for&nbsp; your&nbsp; complaints</h2>
            </header>
            <span class="image newfeatured"><img src="<?php echo base_url(); ?>/public/images/pic01.jpg" alt="" /></span>
        </section>
    </section>
    <div id="fadeandscale" style="">
            <div class="box">
                <div id="type">
                        <h3>What's New</h3>
                        -> Simpler and More Secure<br>
                        -> Forgot Password optionality<br>
                        -> Performance Enhancements<br>
                        -> Bugs or Issues? drop an email<br>
                        -> saurabhgarg510@gmail.com

                </div>
            </div>
    </div>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <!-- Include jQuery Popup Overlay -->
    <script src="http://vast-engineering.github.io/jquery-popup-overlay/jquery.popupoverlay.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize the plugin
            $('#fadeandscale').popup({
                transition: 'all 0.3s' //optional
            });
        });
    </script>