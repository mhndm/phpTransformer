<html>
<head>
<script language="javascript">
var a;
var startup=36*36/2+4;
var snake;
var b=-1;
var direction=39;
var increment;
var hposition=startup;
var delay;
var bonus;
function pause(numSeconds)
{
    var now, goalTime;

    now = new Date();
    goalTime = now.getTime() + 1000*numSeconds;

    while (now.getTime() < goalTime) {
        now = new Date();
    }
}

function Init()
{
a=new Array(36);
for(var i=0;i<1296;i++)
a[i]=0;
snake= new Array(8);
for(var i=0;i<8;i++)
snake[i]=startup-i;
delay=400;
GenerateBonus();
}
function GenerateBonus()
{
	
	while(1)
	{
	var randomnumber=Math.floor(Math.random()*1296);
	//alert(randomnumber);
	for(var i=0;i<8;i++)
if(snake[i]==randomnumber)
continue;
bonus=randomnumber;
break;

	}
	
		var res=document.getElementById(randomnumber);

res.style.backgroundColor="green"
res.style.color="green";
	
	}
function DrawFailed()
{
	document.write("<p><h1><center>You Failed</center></h1></p>");
	
	}
	function DrawSuccess()
{
	document.write("<p><h1><center>You Successed</center></h1></p>");
	}
	function CheckBonus()
	{
		if(snake[0]==bonus)
		{
	var res=parseInt(document.main.score.value);
	if(res==20)
	DrawSuccess();
			document.main.score.value=res+1;
			
			delay-=20;
			GenerateBonus();
			
			}
		
		
		}
function CheckFailed()
{
	
for(var i=0;i<8;i++)
if(snake[i]==hposition)
return true;	
	
	if(hposition>1296||hposition<0)
return true;

if((snake[0]%36==0)&&((snake[1]+1)%36==0))
//if(direction==39)
return true;
if(((snake[0]+1)%36==0)&&((snake[1])%36==0))
//if(direction==37)
return true;
return false;

	
	}
function Set(pos)
{
	for(var i=7;i>0;i--)
	snake[i]=snake[i-1];
	snake[0]=pos;}
function displayunicode(e){
//var unicode=e.keyCode? e.keyCode : e.charCode
var unicode=e.keyCode;
switch(unicode)
{
	
case 37:if(direction==39)return;increment=-1;direction=37;break;
case 38:if(direction==40)return;increment=-36;direction=38;break;	
case 39:if(direction==37)return;increment=1;direction=39;break;
case 40:if(direction==38)return;increment=36;direction=40;break;
default:return;
	}
	WalkDelay();
}
function Walk()
{
	CheckBonus();
	
	var res=document.getElementById(hposition);

res.style.backgroundColor="red"
var rs=document.getElementById(snake[7]);

rs.style.backgroundColor="white"
rs.style.color="white";
Set(hposition);
hposition+=increment;
if(CheckFailed())
{	
	pause(3);
DrawFailed();
return;
}

	setTimeout("Walk()",delay);
	
	
	
	}
function WalkDelay()
{
	if(b==-1)
	{
		//alert("a");
		if(direction==37)
		alert("a");
	Walk();
	b=0;
	}

		}
</script>

</head>
<body onLoad="Init()">
<form name="main">
<label><bold>Your Score is:</bold></label><input type="text" id="score" name="score" value=0 style="background-color:yellow"/>
<table border="10" style="border-color:#036">
<tr style="border-color:#039"><td>
<?php
echo '<table border="0" style="color:white" onKeyDown="displayunicode(event)" onKeyUp="">';
$count=0;
for($i=0;$i<36;$i++)
{
echo '<tr valign="middle" align="middle">';
for($j=0;$j<36;$j++)
{
echo '<td  width="10px" height="10px" id='.$count.'>:::::</td>';
$count++;
}
echo '</tr>';

}

?>
</td></tr></table>
</form>
</body>
</html>