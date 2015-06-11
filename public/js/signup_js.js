// JavaScript Document

function val()
{
	var flag=1;
	for(var i=0;i<2;i++)
	if(document.getElementsByTagName("input")[i].value=='')
	{
		flag*=0;
		document.getElementById("fname").className='invalid';
		document.getElementById("lname").className='invalid';
		
		}
		else
		{
			flag*=1;
			document.getElementById("fname").className='';
		document.getElementById("lname").className='';
		}
		for(var i=5;i<7;i++)
	if(document.getElementsByTagName("input")[i].value=='' || document.getElementsByTagName("input")[i].length <8)
	{
		flag*=0;
		document.getElementById("pass").className='invalid';
		document.getElementById("repass").className='invalid';
		}
		else
		{
			flag*=1;
			document.getElementById("pass").className='';
		document.getElementById("repass").className='';
		}
		if(document.getElementById("pass").value!=document.getElementById("repass").value)
		{
			flag*=0;
			document.getElementById("pass_wrong").style.display='block';
		}
		else
		{
			flag*=1;
			document.getElementById("pass_wrong").style.display='none';
		}
		var exp1=/^([EW])([A-F])-([1-8]([1][01]|[0][1-9]))$/i;
		var chk=exp1.test(document.getElementById("roomno").value);
		if(chk==false)
		{flag*=0;
		document.getElementById("roomno").className="invalid";
		document.getElementById("roomno").value="";
		}
		else
		{
			flag*=1;
			document.getElementById("roomno").className="";
		}
		var exp2=/^\d{9}$/;
		chk=exp2.test(document.getElementById("rno").value);
		if(chk==false)
		{
			flag*=0;
			document.getElementById("rno").className="invalid";
			document.getElementById("rno").value="";
		}
		else
		{
			flag*=1;
			document.getElementById("rno").className="";
		}
		var exp3=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		chk=exp3.test(document.getElementById("email").value);
		if(chk==false)
		{
			flag*=0;
			document.getElementById("email").className="invalid";
			document.getElementById("email").value="";
		}
		else
		{
			flag*=1;
			document.getElementById("email").className="";
		}
		var exp4=/^\d{10}/;
		chk=exp4.test(document.getElementById("mno").value);
		if(chk==false)
		{
			flag*=0;
			document.getElementById("mno").className="invalid";
			document.getElementById("mno").value="";
		}
		else
		{
			flag*=1;
			document.getElementById("mno").className="";
		}
		if(flag)
		send();
		else
		return;
	}
	function send()
	{
		document.getElementById("signup").disabled = true; 
		$.ajax({
            type: 'post',
            url: 'register.php',
			data:{
				fname:$("#fname").val(),
				lname:$("#lname").val(),
				pass:$("#pass").val(),
				rno:$("#rno").val(),
				email:$("#email").val(),
				mno:$("#mno").val(),
				roomno:$("#roomno").val()
			},
            success: function (data) {
				if(data=="error")
				{
					document.getElementById("signup").disabled = false;
					document.getElementById("regfail").style.display='block';
					}
					else
					{
						$.ajax({
            type: 'post',
            url: 'signin.php',
			data:{
				password:$("#pass").val(),
				email:$("#email").val()
			},
            success: function (data) {
				window.location.assign(data);
					}
				});
					}
			}
		});
	}
	function chk()
	{
		if(document.getElementById("roomno").value.length==2)
		{document.getElementById("roomno").value+='-';}
	if (event.keyCode == 13) document.getElementById('signup').click();
	}