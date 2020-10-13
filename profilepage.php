
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="assets/bootstrap.min.css">
        <script src = "assets/bootstrap.min.js"></script>
        <script src="assets/jquery.min.js"></script>
        <script src="assets/popper.min.js"></script> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">            <!--  -->
        <title>profile page</title>

        <style>
            /* .container-fluid {
                width: 100%;
                padding: 0px;
            } */

            body {
                margin: 0px;
                
	           padding: 0;
	           background-image: linear-gradient(180deg,rgb(60,0,80)50%,#EEE 50%);
	           
                /* background-color: #EEE; */
            }

            .navbar {
                top:-10px;
                box-shadow: 0 5px 5px -5px #888888;
                background-color: #FFF;
            }

            .nav-item {
                padding: 0px 16px;  
            }

            .navbar.navbar-light li a.nav-link{
                font-weight: bold;
                color: indigo;    
            }

            .nav-link:hover {
                color: black;
            }

            footer {
                width: 100%;
                position: relative;
                bottom: 100%;
            }

            .footer {
                background-color:rgb(65, 0, 80);
                margin-top: 1em;
                font-size: 75%;
                color: white;   
                padding: 20px 20px ;
                display: flex;
                position: relative;
                flex-direction: row;
                flex-wrap: wrap;
                /* position: relative; */
                
      			left: 0;
      			bottom: -8px;
     			width: 100%;

            }

            .footer a, .footer p{
                padding: 10px 50px;
            }

            .my-profile{
                display: block;
                border: 1px solid grey;
                padding: 10px;
            }

            .my-profile img{
                width: 40px;
                height: 40px;
                object-fit: cover;
            }

            .my-profile p{
                display: inline;
                padding-left: 5px;
            }

            .container{ 
                min-width: 80%;
            }
            
            .box{
 				position: relative;
                width: 60%;
                height: max-content;
                background-color: white;
                padding: 50px;
                text-align: left;
                margin-top: 220px;
                margin-left: 20%;
                color: black;
                box-shadow: 0px 2px 8px rgb(65,0,80);   
            }
            h2{

                color: rgb(65,0,80);
                text-align: center;
                
            }
            h6{
                color: rgb(65,0,80);
            }
            div {
                padding: 8px;
                border: grey thin ;

            }
            .p2{
                padding:8px;
                border-style: none;
                background-color:lightgrey;
            }

            .profilepic img{
                width: 180px;
                height: 180px;
                padding: 1px;
                top: -70px;
                margin-top: -20px;
                margin-left: 35%;
                object-fit: cover;
                position: absolute;
                background-color: white;
                border:5px solid rgb(65,0,80);
                left: 50%;
                margin-left: -90px;

            }

            .header2{
                display: block;
                cursor: pointer;
                text-decoration: none;
                font-weight: bold;
                transition: 0.2s;
            }

            .header2:hover{
                transform: scale(1.01);
                transition: 0.2s;
            }

            #logout{
                padding: 20px 0px;
            }

            .logout{
                margin-top: 3px;
                margin-left: 4px;   
                font-size: 28px;
                vertical-align: bottom;
            }
            


        </style>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>

    </head>
    <body>

        <header>
            <div class="container-fluid fixed-top">
                <nav class="navbar navbar-expand-sm navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Events</a>
                            </li>
                        </ul>
                    </div>
                    <a href="" class="navbar-brand mx-auto">
                        <img src="assets/alumni.png" style = "height: 70px; width: 110px; object-fit: cover">
                    </a>
                    <div class="collapse navbar-collapse" id="collapse">
                        <ul class = "nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="#login" class = "nav-link">
                                    <div class="my-profile">
                                        <img class="rounded-circle" src="profilepic.jpg">
                                        <p>Alumnus I</p>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="logout" href="models/logout.php" class="nav-link">Logout<span class="material-icons logout">power_settings_new</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Your Content -->
        <?php
        
		if(isset($_GET['email'])){
            $email = $_GET['email'];
        } else {
            $email = $_SESSION['email'];
        }
    		$email=$_GET['email'];
    		$con=mysqli_connect("localhost:3306 ","root","root1234","alumni_tracking") or die("could not connect to the server");
    		$userquery=mysqli_query($con,"SELECT * FROM user_details WHERE user_id =(SELECT user_id FROM users WHERE email='$email');") or die("the querry is not completed");
    		if(mysqli_num_rows($userquery)!=1)
    		{
        		die("The username could not be found");
    		}
    		while ($row=mysqli_fetch_array($userquery,MYSQLI_ASSOC)) {
    			$userid=$row['user_id'];
                $fullname=$row['fullname'];
                $dob=$row['dob'];
                $phnum=$row['primary_phone'];
                $gender=$row['gender'];
                $batchid=$row['batch_id'];
                $courseid=$row['course_id'];
                $collegeid=$row['college_id'];
                $deptid=$row['dept_id'];
                $univid=$row['current_university_id'];
                $empid=$row['current_employer_id'];
                $img=$row['image'];
            }
                
            $colquery=mysqli_query($con,"SELECT * FROM colleges co,batches b WHERE co.college_id='$collegeid' and b.batch_id='$batchid'")  or die("the querry is not completed");

            if(mysqli_num_rows($colquery)!=1)
            {
                die("The username could not be found");
            }

            while ($row=mysqli_fetch_array($colquery,MYSQLI_ASSOC)) {
                $colab=$row['college_name'];
                $start=$row['from_year'];
                $end=$row['to_year'];    
            }

            $couquery=mysqli_query($con,"SELECT * FROM courses c,departments d WHERE c.course_id='$courseid' and d.dept_id='$deptid' ")  or die("the querry is not completed");

            if(mysqli_num_rows($couquery)!=1)
            {
                die("The username could not be found");
            }

            while ($row=mysqli_fetch_array($couquery,MYSQLI_ASSOC)) {
                $course=$row['course_name'];
                $dept=$row['dept_name'];
            }
    
?>
        <div class="box" >
            <div class="profilepic"><img src=<?php echo $img ?> ></div>
            <br>
            <br>
            <h2><?php if($gender=='F'):?><span class="fa fa-venus" aria-hidden="true"></span><?php else:?><span class="fa fa-mars" aria-hidden="true"><?php endif; ?></span><b><?php echo "   $fullname" ?></b></h2>
            <a class = "header2" onclick="goBack()"><h6>< BACK TO RESULTS</h6></a>
            
            <div class="row">
                <div class="col-sm-12">
                    <div style='border-style: ridge;'><h6><b>DATE OF BIRTH</b></h6><p><?php echo $dob ?></p></div>
                    <br>
                    <div style='border-style: ridge;'><h6><b>COLLEGE</b></h6><p><b><?php echo $colab ?> (<?php echo $course ?>)</b><br>Department of <?php echo $dept ?><br>Batch of <?php echo $start ?>-<?php echo $end ?></p></div>
                    <br>
                    <?php 
                    $wquery=mysqli_query($con,"SELECT * from employments emp, employers e WHERE e.employer_id = emp.employer_id and emp.user_id ='$userid'")  
                    or die("the querry is not completed");
    				if(mysqli_num_rows($wquery)>0)
    				{ ?>
    					<div style='border-style: ridge;'><h6><b>WORK EXPERIENCE</b></h6>
    					<?php 	
        				while ($row=mysqli_fetch_array($wquery,MYSQLI_ASSOC)) 
        				{
        					$wname=$row['employer_name'];
        					$ws=$row['from_year'];
        					$we=$row['from_year'];
        					$des=$row['designation'];?>
        					<p class="p2"><b><?php echo $wname ?></b><br><?php echo $ws ?>-<?php echo $we ?><br><?php echo $des ?></p>
        					
        				<?php } ?></div><br>

                    <?php } ?>
                    <?php 
                    $univquery=mysqli_query($con,"SELECT * FROM universities u ,higher_studies h WHERE u.university_id='$univid'")  or 
                    die("the querry is not completed");
    				if(mysqli_num_rows($univquery)>0)
    				{
    					while ($row=mysqli_fetch_array($univquery,MYSQLI_ASSOC)) {
        					$univname=$row['university_name'];
        					$location=$row['location'];
        					$hstart=$row['from_year'];
        					$hend=$row['to_year'];
    					} ?>

                    <div style='border-style: ridge;'><h6><b>HIGHER STUDIES</b></h6><p><?php echo $univname ?><br><?php echo $location ?><br>
                        batch of <?php echo $hstart ?><?php echo $hend ?></div>
                    <br><?php } ?>
                    <div style='border-style: ridge;'><h6><b>EMAIL ADDRESS</b></h6><p><?php echo $email ?></p></div>
                    <br>
                    <div style='border-style: ridge;'><h6><b>PHONE NUMBER</b></h6><p><?php echo $phnum ?></p></div>
                    <br>
                    <div><button class="btn btn-warning">Connect via <b>Linkedin</b></button></div>
                </div>
                
            </div>
        </div>

        <footer>
            <div class="container-fluid ">
                <div class="footer">
                    <p>Alumni connect site of <b>Rajalakshmi Engineering College</b></p>
                    <p class="ml-auto">&copy Designed by the students of <b>Computer Science & Engineering</b></p>
                </div>
            </div>
        </footer>

    </body>
</html>