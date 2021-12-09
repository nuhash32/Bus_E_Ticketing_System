<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
?>
<!DOCTYPE html>
<html>
<head>
<style>
* {
margin : 0;
padding : 0;
}
img, a {
border : none;
outline : none;
}
li {
margin : 0;
padding : 0;
}
body {
background-color: #282c34;
font : smaller Arial, Helvetica, sans-serif;
line-height : 1.3em;
color : #f6e8d2;
}
#wrapper {
width : 960px;
margin : 0 auto;
padding : 0 0 14px 0;
overflow : hidden;
}
#header {
float : left;
width : 960px;
}

#mainnav {
float : right;
list-style-type : none;
display : inline;
margin : 120px 30px 0 0;
font-weight : lighter;
overflow : hidden;
}

#mainnav li a {
float : left;
text-transform : uppercase;
color : black;
text-decoration : none;
padding : 5px 12px 5px 12px !important ;
margin : 0 0 0 2px;
}

#mainnav li.current a:link {
background : top left repeat-x transparent;
color : black;
}
#mainnav li.current a:visited {
background : top left repeat-x transparent;
color : black;
}

#content {
float : left;
background: grey;
width : 860px;
min-height : 377px;
padding : 10px;
margin : 0 0 20px 50px;
}

div#rotator {
position : relative;
height : 345px;
}
div#rotator ul li {
z-index : 3;
float : left;
list-style : none;
position : absolute;
}
div#rotator ul li.show {
z-index : 2;
}
* html div#rotator {
margin : 0 0 43px 0;
}
#footer {
float : left;
width : 880px;
padding : 0 0 0 50px;
color : white;
font-size : 100%;
text-align : center;
}

.clearfix {
clear : both;
}
</style>

<title>Bus E-Ticket | Project Developed for CSC 469</title>

<script src="js/jquery-1.5.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vallenato/vallenato.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="vallenato/vallenato.css" type="text/css" media="screen" charset="utf-8">

		<script type="text/javascript">
		$("#slideshow > div:gt(0)").hide();

		setInterval(function() { 
		  $('#slideshow > div:first')
			.fadeOut(1000)
			.next()
			.fadeIn(1000)
			.end()
			.appendTo('#slideshow');
		},  3000);
	</script>
	<!--sa calendar-->	
		<script type="text/javascript" src="js/datepicker.js"></script>
        <link href="css/demo.css"       rel="stylesheet" type="text/css" />
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		
		function makeTwoChars(inp) {
				return String(inp).length < 2 ? "0" + inp : inp;
		}

		function initialiseInputs() {
				document.getElementById("sd").value = "";
				document.getElementById("ed").value = "";

				datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
		}

		var initAttempts = 0;

		function setReservationDates(e) {

				try {
						var sd = datePickerController.getDatePicker("sd");
						var ed = datePickerController.getDatePicker("ed");
				} catch (err) {
						if(initAttempts++ < 10) setTimeout("setReservationDates()", 50);
						return;
				}

				var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

				if(dt == 0) return;

				
				var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

				ed.setRangeLow( dt );
				
				if(edv < dt) {
						document.getElementById("ed").value = "";
				}
		}

		function removeInputEvents() {
				datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
		}

		datePickerController.addEvent(window, 'load', initialiseInputs);
		datePickerController.addEvent(window, 'unload', removeInputEvents);
		</script> 
	<style>
		img.logo {
		    left: 216px;
		}
	</style>

</head>

<body>
<div id="wrapper">
	<div id="header">
        <ul id="mainnav">
			
    	</ul>
	</div>
    <div id="content">
    	<div id="rotator">
		<ul>
                    <li><img src="xres/images/jb2/01.jpg" width="861" height="379"/></li>
              </ul>
			  <div id="logo" style="left: 600px; height: auto; top: 23px; width: 260px; position: absolute; z-index:4;">
					
					<h2 class="accordion-header" style="height: 18px; margin-bottom: 15px; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(53, 48, 48);">Ticket Booking</h2>
					<div class="accordion-content" style="margin-bottom: 15px;">
						<form action="selectset.php" method="post" style="margin-bottom:none;">
						<span style="margin-right: 11px;">Select Route: 
						<select name="route" style="width: 191px; margin-left: 15px; border: 3px double darkgrey; padding:5px 10px;"/>
						<?php
						include('db.php');
						$result = mysqli_query($conn,"SELECT * FROM route");
						while($row = mysqli_fetch_array($result))
							{
								echo '<option value="'.$row['id'].'">';
								echo $row['route'].'  :'.$row['type'].'  :'.date("h:i A",strtotime("2020-01-01 ".$row['time']));
								echo '</option>';
							}
						?>
						</select>
						</span><br>
						<span style="margin-right: 11px;">Date: 
						<input type="text" class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" value="" maxlength="10" readonly="readonly" style="width: 165px; margin-left: 15px; border: 3px double #CCCCCC; padding:5px 10px;"/>
						</span><br>
						<span style="margin-right: 11px;">No. of Passenger: 
						<select name="qty" style="width: 191px; margin-left: 15px; border: 3px double #CCCCCC; padding:5px 10px;">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						</select>
						</span><br><br>
						<input type="submit" id="submit" value="Next" style="height: 34px; margin-left: 15px; width: 191px; padding: 5px; border: 3px double rgb(204, 204, 204);" />
						</form>
					</div>
					<h2 class="accordion-header" style="height: 18px; margin-bottom: 15px; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(53, 48, 48);">Admin Login</h2>
					<div class="accordion-content" style="margin-bottom: 15px;">
						<form action="login.php" method="post" style="margin-bottom:none;">
						<span style="margin-right: 11px;">Username: <input type="text" name="username" style="width: 165px; margin-left: 15px; border: 3px double #CCCCCC; padding:5px 10px;"/></span><br>
						<span style="margin-right: 11px;">Password: <input type="password" name="password" style="width: 165px; margin-left: 15px; border: 3px double #CCCCCC; padding:5px 10px;"/></span><br><br>
						<input type="submit" id="submit" class="medium gray button" value="Login" style="height: 34px; margin-left: 15px; width: 191px; padding: 5px; border: 3px double rgb(204, 204, 204);" />
						</form>
					</div>
				</div>
        </div>
		
    </div>

	<div id="footer">
	<p>Project Developed for CSC 469</p>
</div>
</div>
</body>
</html>
