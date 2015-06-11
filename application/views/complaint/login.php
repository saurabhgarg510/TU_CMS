        <script src="../../../public/js/login_js.js"></script>
        <!-- Main -->
        <section id="main" class="container small" >

            <header>
                <h2>Sign In</h2>
                <!--<p></p>-->
            </header>
            <div class="box">
                <form method="post" action="home.php">
                    <div class="row uniform half">
                        <div class="12u">
                            <input type="text" name="username" id="username" placeholder="Email" required/>
                        </div>
                    </div>
                    <div class="row uniform half">
                        <div class="12u">
                            <input type="password" name="password" id="password" placeholder="Password" onkeyup="if (event.keyCode == 13)
                                        document.getElementById('signin').click()" required/>
                        </div>
                    </div>

                    <div class="row uniform half">
                        <div class="12u">
                            <center>
                                <label id="incorrect" style="display:none;color:red">Incorrect Email ID or Password</label>
                            </center>
                        </div>
                    </div>
                    <div class="row uniform">
                        <div class="12u">
                            <ul class="actions align-center">

                                <li><a><input type="button" id="signin" onClick="val()" value="Sign In" /></a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </section>
