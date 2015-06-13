<?php
	$rec_limit = 15;
	require_once(APPPATH."libraries/functions.php");
?>       
	<script src="../../../public/js/print.js"></script>
    <script type="text/javascript" src="../../../public/js/jquery.tablesorter.js"></script>
    <script type="text/javascript">$(function() {
            $('#keywords').tablesorter({debug: true});
        });</script>
    <script src="../../../public/js/complaint_ct.js" type="text/javascript"></script>
    
    <section id="main" class="container large">
        <div class="row">
            <div class="12u" id="filter">
                <form action="http://localhost/ci/index.php/admin/filter/" method="get" id="form">
                    <section class="box" style="padding-top: 15px; padding-bottom: 15px; ">
                        <h1> Filters </h1>
                       <div class="row">
                    <div class="4u">
                    <select class="dd" name="fcat">
                        <option hidden="" value="<?php if(isset($_SESSION['fcat']))echo $_SESSION['fcat']; else echo ""?>"><?php if(isset($_SESSION['fcat'])&&$_SESSION['fcat']!=''){echo $_SESSION['fcat'];}else echo "Category";?></option>
                        <?php foreach($category as $cat) { ?>
                            <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                        <?php } ?>
                        <option value="">All</option>
                    </select> </div>
                   <div class="4u">
                    
                    <select class="dd" name="fwing">
                        <option hidden="" value="<?php if(isset($_SESSION['fwing']))echo $_SESSION['fwing']; else echo ""?>"><?php if(isset($_SESSION['fwing'])&&$_SESSION['fwing']!=''){echo $_SESSION['fwing'];}else echo "Wing";?></option>                            
                        <option value="West" >West</option>
                        <option value="East" >East</option>
                        <option value="">All</option>
                    </select>
                    </div>
                    <div class="4u">
                    <select class="dd" name="fstat">
                        <option hidden="" value="<?php if(isset($_SESSION['fstat']))echo $_SESSION['fstat']; else echo ""?>"><?php if(isset($_SESSION['fstat'])&&$_SESSION['fstat']!=''){echo $_SESSION['fstat'];}else echo "Status";?></option>                            
                        <option value="Pending">Pending</option><option value="Waiting">Waiting</option>
                        <option value="Complete">Completed</option>
                        <option value="Urgent">Urgent</option>
                       <option value="">All</option> 
                    </select>
                    </div></div>
                    
                    <div style="margin-bottom:20px"> Sort complaints from
                        <br />
                      <div class="row"> <div class="4u"> <input type="date" name="f_sdate" value="<?php if(isset($_SESSION['f_sdate']))echo $_SESSION['f_sdate'];?>"/></div>
                      <div class="4u"> <input type="date" id="f_edate" name="f_edate" value="<?php if(isset($_SESSION['f_edate']))echo $_SESSION['f_edate'];?>"/></div>
                    <div class="4u">
                    <ul class="actions" >
                        <li class="4u"><a onclick="document.getElementById('form').submit()" class="button special" >Search</a></li>
                        <li class="3u" style="margin-right: 20px;"><a href="warden.php" class="button special" >Reset</a></li>
                        <li class="3u"><a class="button special" onclick="printDiv('print')" >Print</a></li>
                    </ul>
                  </div>
                  </div>

                </section>
                </form>
            </div>
        </div>
        </div>

        <!---------------------------------------- POPUP start ------------------------->

        <div id="my_popup" style="text-align:center; width: 75%; height: 600px; padding: 0px;">

                <table style="text-align:left">
                    <tr>
                        <th>Name</th>
                        <th>Complaint Id</th>
                        <th>Category</th>
                        <th>Room No</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th style="width: 25%">Details</th>
                    </tr>
                    <tr id="ajaxdata">
                    </tr>
                </table>
                <div class="box" style="padding: 15px;">
                    <div class="row uniform">
                        <div class="12u">
                            <center><h3>Remarks</h3></center>
                            <table style="text-align:center" id="getremark">
                                    <?php // Loaded through ajax ?>
                            </table>            
                        </div>
                    </div>
                <br>
            <center>
               
                    <form >
                        <div class="row uniform">
                            <div class="4u">
                                <br />
                                <div class="12u" style="display:none">
                                    Expected Completion Date
                                    <input type="date" name="complete" id="complete" required/>
                                </div><br />            
                                <div class="12u">
                                    <select class="dd" id="status">
                                <?php if ($_SESSION['user_type']=="warden") { echo '
                                        <option value="" hidden="">Status</option>
                                        <option value="Urgent" >Urgent</option>
                                        </div> '; } 
								else { echo '
                                        <option value="" hidden="">Status</option>
                                        <option value="Waiting" >Waiting</option>
                                        <option value="Complete">Completed</option>
                                '; }	?>
                                    </select>
                                </div>
                                </div>
                                <div class="8u">
                                    <textarea placeholder="Remarks" id="remark" rows="4" style="resize:none"></textarea>
                                </div>
                        	</div>
                            <br><input type="button" class="button" value="Update" onclick="update()"/>
                        </div>
                    </form> 
            	</div>
            </div>

        <!---------------------------------------- POPUP end ------------------------->
        <!--------------------------------- Filters Start---------------------------------------->             

            <div class="row">
                        <div class="12u" >
                            <section class="box" id="print">
            <h1 style="font-size:32px;text-align:center;margin-top:0px"> Complaints  </h1>
						<div class="table-wrapper">
                           <table id="keywords" class="tablesorter" >
                            <thead>
                                <tr>
                                   <!-- <th><input type="checkbox" id="all"><label></label> </th>-->
                                    <th>Complaint Id</th>
                                    <th>Category</th>
                                    <th>Details</th>
                                    <th>Room No</th>
                                    <th>Complaint Type</th>
                                    <th>Contact</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!---------------------------------------Filters end----------------------------------------------->                         <?php foreach($row as $val) { ?>
                            <tr>
                            
                               <!-- <td><input type="checkbox" id="1" name="all" onclick="check()"/><label></label> </td>-->
                                <td><a class="my_popup_open" onclick=" show(<?php echo $val['comp_id']; ?>); "><?php echo $val['comp_id']; ?></a></td>
                                <td><?php echo $val['category']; ?></td>
                                <td width="20%"><?php echo str_replace(array("\\r\\n","\\r","\\n"), "<br>",$val['details']); ?></td>
                                <td><?php echo $val['roomno']; ?></td>
                                <td><?php echo $val['comp_type']; ?></td>
                                <td><?php //echo $val1['contact']; ?></td>
                                <td><?php echo format_date($val['comp_date']); ?></td>
                                <td><?php
                                    if ($val['status'] == 'Pending') {
                                        echo "<b style='color:blue'>" . $val['status'] . "</b>";
                                    } else if ($val['status'] == 'Complete') {
                                        echo "<b style='color:green'>" . $val['status'] . "</b>";
                                    } else if ($val['status'] == 'Urgent') {
                                        echo "<b style='color:red'>" . $val['status'] . "</b>";
                                    } else {
                                        echo $val['status'];
                                    }
								}?></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        </div>
        </center>
    </section>
  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <!-- Include jQuery Popup Overlay -->
  <script src="http://vast-engineering.github.io/jquery-popup-overlay/jquery.popupoverlay.js"></script>
  <script>
    $(document).ready(function() {
      // Initialize the plugin
      $('#my_popup').popup();

    });
  </script>
