<?php
session_start();
include_once('config/database.php');

if(!isset($_SESSION['username'])){
    header('location: login.php');
}
else {
$username=$_SESSION['username'];
$get_user="select * from users where username='$username'";
$run_user=mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);
$id=$row['id'];
$user_password=$row['password'];


?>
<html>
<head>
<title>Railway Tweets Portal</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  
	  <style>
	  	
		tr{
			border-bottom: 3px groove;
		}
		td {
	  
	  		padding:20px;
	  
		}
	    .active{color:white;}
	  	.line{border-right: 2px groove;min-height:98.5vh;overflow-x:hidden;}
	  	.left{
	  		width:70%;
	  		float:left;
	  	}
	  	.right{
	  		float: left;
	  		width:25%;
	  	}	
		.navbar-right{
			margin-right:40px;
		}
		
	  </style>	
	  <script>
	// 	window.setInterval(function() {
	//         if (window.XMLHttpRequest) {
	//             xmlhttp = new XMLHttpRequest();
	//         } else {
	//             xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	//         }
	//         xmlhttp.onreadystatechange = function() {
	//             if (this.readyState == 4 && this.status == 200) {
	//                 bind();
	//                 document.getElementById("feedback-content").innerHTML = this.responseText;
	//             }
	//         };
	//         xmlhttp.open("GET","feedback.php",true);
	//         xmlhttp.send();
	// },5000);

	window.setInterval(function() {
	        if (window.XMLHttpRequest) {
	            xmlhttp = new XMLHttpRequest();
	        } else {
	            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	                bind();
	                document.getElementById("emergency-content").innerHTML = this.responseText;
	            }
	        };
	        xmlhttp.open("GET","emergency.php",true);
	        xmlhttp.send();
	    
	},5000);


	$(document).ready(function bind(){
	  	
	    $('body').on('click','.add',function(){
	        //... event handler code ....
	        document.getElementById("selection").innerHTML = "";
	          var $this = $(this),
	          myCol = $this.closest("td"),
	          myRow = myCol.closest("tr"),
	          targetArea = $("#selection");
	          targetArea.append(myRow.children().not(myCol).text() + "<br />");
	       	document.getElementById("idvalue").value = myRow.children(".value").children(".myval").val();
	    });
	  });


			function sendReply(form){
	  				var tweet_id = form.idvalue.value;
	  				var tweet_reply = form.tweet_reply.value;
	        	console.log("tweet_id="+tweet_id+"&tweet_reply="+tweet_reply);

	  				if (tweet_reply) {
	        	console.log("tweet_id="+tweet_id+"&tweet_reply="+tweet_reply);

	  					 if (window.XMLHttpRequest) {
	           					 xmlhttp = new XMLHttpRequest();
	        						} else {
	            	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4) {
	            		if (this.status == 200) {
	            			alert('Tweet Sent !');
	            			form.tweet_reply.value= "";
	            		}	else {
	            			alert('Tweet Not Sent !');

	            		}
	            }
	        };
	        	var query = "tweet_id="+tweet_id+"&reply="+tweet_reply;
	        	xmlhttp.open("GET","reply.php?"+query,true);
	        	xmlhttp.send();
	  				}
	  			}
	</script>
	</head>

	<body class="line">  
		<div class="navbar " style="width:101%; padding-bottom:10px; padding-top:10px; background-color: #574b90;" id="main">
			<ul style="font-size: 29px; margin-top: 5px; cursor: pointer;">
			
				<li class="active" style="display:inline; margin-right: 15px"; data-toggle="tab" href="#emergency">
					Emergency
				</li>
				<li style="display:inline; margin-right: 15px;" data-toggle="tab" href="#feedback">
					Feedback
				</li>
				<a style=" text-decoration: none; color:black" href="chartjs.php">
				<li class="" style="display:inline; font-color:black"  href="chartjs.html">
					Tweets Analysis
				</li></a>
				<li style="display:inline;">
				<a href="logout.php"><button class="btn btn-primary navbar-right b2" > logout </button></a>
				</li>
			</ul>
		</div>
			<div class='tab-content left'>
				<div id="emergency" class='tab-pane fade in active'>
					<div id='emergency-content' style="width:90%;padding: 50px;margin:auto;background:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
						<table>
	                    <?php
	                       if ($con->connect_error) {
	                         die("Connection failed: " . $con->connect_error);
	                        } 
							$sql = "select * from tweets where prediction=1 order by id desc;";
							$result = $con->query($sql);
							$i=1;
							if ($result->num_rows > 0) {
	    					  while($row = $result->fetch_assoc()) {
	        					echo "<tr><td style='color:black' width='180%'>";
	        					echo $row["tweet"];
	        					echo "</td><td width='20%'><button type='button' class='btn btn-info add'><b>Reply</b></button></td>";
	        					echo "<td class='value'><input type='hidden' id='tweet_value' class='myval' name='tweet_value' value=".$row["tweet_id"]."></td></tr>";
	        					$i++;
	    					    }
							} 
	                    ?>
						</table>
					</div>	
				</div>
		        <div id="feedback" class='tab-pane fade'>
					<div id='feedback-content' style="width:90%;padding: 50px;margin:auto;background:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
						<table>
						<?php
							$sql = "select * from tweets where prediction=0 order by id desc;";
							$result = $con->query($sql);
							$i=1;
							if ($result->num_rows > 0) {
	    					   while($row = $result->fetch_assoc()) {
	        					echo "<tr><td style='color:black' width='180%'>";
	        					echo $row["tweet"];
	        					echo "</td><td width='20%'><button type='button' class='btn btn-info add'><b>Reply</b></button></td>";
	        					echo "<td class='value'><input type='hidden' id='tweet_value' class='myval' name='tweet_value' value=".$row["tweet_id"]."></td></tr>";
	        					$i++;
	    					   }
							} 
						?>
						</table>
					</div>	
				</div>			
			</div>
			<div class="container-fluid right">
				<div id="selection" style="min-height:200px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);font-size: 16px;padding:10px;"></div>
				<h3 style="color:#c6c6c6;">Type your response...</h3>
				<form>
					<input type="hidden" name="idvalue" id="idvalue" value="">
	  				<textarea id="tweet_reply" name="tweet_reply" rows="10" style="width:100%;"></textarea>
	  				<button type="button" class="btn btn-info" style="width:100%;margin-top: 10px;" onclick="sendReply(this.form)">Reply</button>
	  			</form>
			  </div>
	</body>
	</html>
	<?php
	}
	?>