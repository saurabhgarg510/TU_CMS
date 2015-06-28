<section id="main" class="container" >
    <header>
        <h3 style="margin-bottom:0px;">Poll Results</h3>
    </header>
    <div class="row">
        <?php
        $i = 1;
        foreach ($query as $ro) { ?>
         <div id="pollDisplay">
        <h3><?php echo $ro['ques']?></h3><button onclick="graph('<?php echo htmlspecialchars($ro['id']); ?>')">Click me</button><br>
         </div>
     <?php   }   
     ?>
        <script>
    function graph(id) {
      
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
        xmlhttp.open("GET", "<?php echo base_url(); ?>index.php/admin/pollgraph?z="+id, true);
        xmlhttp.send();
        return false;
    }
</script>