//function comment
function CommentPost()
{
	if(window.XMLHttpRequest)
	{		
		xmlhttp=new XMLHttpRequest();

	}
	else
	{
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	
	xmlhttp.onreadystatechange= function ()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//document.getElementById('message').innerHTML=xmlhttp.requestText;	
			var alert=xmlhttp.requestText
			alert(alert);
		}
		
	}
		
		parameter=document.getElementById('commenting').value;
		xmlhttp.open("GET","/programs/getuser.php?q="+parameter, true);
		//xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send();
	
}
//function showtopics


function ShowTopicss(str)
{
	if(str=="")
	{
		document.getElementById("topics").innerHTML="<option>HELLO</option>";
		return;
	}
	
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			
				document.getElementById('topics').innerHTML=xmlhttp.requestText
				
			}
		
		}
		
		var data="topics=" +str;
		xmlhttp.open('GET', 'select.php', true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", data.length);
		xmlhttp.setRequestHeader("Connection", "close");

		xmlhttp.send(data);
}


function Showtopic(str)
{
	if(str=="")
	{
		document.getElementById("topics").innerHTML="<option></option>";
		return;
	}
	if(str=="Education")
	{
		document.getElementById("topics").innerHTML="<option>Importance of Education</option><option>History of Education</option>University Education<option>Role of Education in society</option>";
		return;
	}
	if(str=="Lifestyle")
	{
		document.getElementById("topics").innerHTML="<option>Urban life</option><option>How to Become Rich</option><option>Positive Living</option>";
		return;
	}
	if(str=="Health")
	{
		document.getElementById("topics").innerHTML="<option>Paramedics Complains</option><option>Balanced Diet</option><option>Drug Abuse Effects</option>";
		return;
	}
	if(str=="Government")
	{
		document.getElementById("topics").innerHTML="<option>Role of Government</option><option>Politicians Challenges</option><option>Advisory System</option>";
		return;
	}
}
//
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getuser.php?q="+str,true);
xmlhttp.send();
}