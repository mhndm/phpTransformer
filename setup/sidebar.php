<?php
if(isset($_GET['step'])){
$Step = $_GET['step'] ;
	if($Step==1){
		echo '<p><a href="index.php">Welcome page</a></p>
				<strong> >Minimum</strong>
				<p>Database </p>
				<p>Email </p>
				<p>Admin  </p>
				<p>Support</p>
				<p>Finish</p>';
	}
	elseif($Step==2){
		echo '<p><a href="index.php">Welcome page</a></p>
				<p>Minimum</p>
				<strong> > Database </strong>
				<p>Email </p>
				<p>Admin  </p>
				<p>Support</p>
				<p>Finish</p>';
	}
	elseif($Step==3){
		echo '<p><a href="index.php">Welcome page</a></p>
				<p>Minimum</p>
				<p>Database </p>
				<strong> >Email </strong>
				<p>Admin  </p>
				<p>Support</p>
				<p>Finish</p>';
	
	}
	elseif($Step==4){
		echo '<p><a href="index.php">Welcome page</a></p>
				<p>Minimum</p>
				<p>Database </p>
				<p> Email </p>
				<strong> > Admin  </strong>
				<p>Support</p>
				<p>Finish</p>';
	
	}
	elseif($Step==5){
		echo '<p><a href="index.php">Welcome page</a></p>
				<p>Minimum</p>
				<p>Database </p>
				
				<p>Admin  </p>
				<strong> > Support</strong>
				<p>Finish</p>';
	
	}
	else{
		echo '<p><a href="index.php">Welcome page</a></p>
				<p>Minimum</p>
				<p>Database </p>
				
				<p>Admin  </p>
				<p>Support</p>
				<strong> > Finish</strong>';
	
	}
}
else{
	echo '<strong><a href="index.php">Welcome page</a></strong>
			<p> - Minimum</p>
			<p> - Database </p>
			
			<p> - Admin  </p>
			<p> - Support</p>
			<p> - Finish</p>';
}
?>