<?php

    if(session_status() == PHP_SESSION_NONE)
    {
        session_start(); //start session if session not start
    }

    if(isset($_SESSION['user_id'])){
        header('location: ../SearchResults.php'); //Navigate to search page if logged in already
    }

	$msg = "";
	$msgClass = "";

    include_once('../config/Database.php');
    include_once('../models/UserDetails.php');

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST['loginEmail'];
		$pass = $_POST['loginPwd'];

        if(isset($email) && isset($pass))
        {   
            $database = new Database;
            $db = $database->connect();
            $user = new UserDetails($db);

            $result = $user->checkUser($email); // function in models/User_Details.php

			$final = $result->fetch(PDO::FETCH_ASSOC);
		

            $num = $result->rowCount();

            if($num!=0 && filter_var($email,FILTER_VALIDATE_EMAIL))
            {   
                $user_id = $final['user_id'];
				$pwd = $final['password'];
			

                if($pass==$pwd)
                {   
                    session_start();
					$_SESSION['user_id'] = $user_id;
					$_SESSION['email'] = $email;
                    $_SESSION['role']= $final['role'];
					$_SESSION['fullname'] = $final['fullname'];
					$_SESSION['image'] = $final['image'];
 
                    header('Location: ../SearchResults.php');
                }
                else
                {
                    $msg = "Incorrect Password";
                    $msgClass = "alert-danger";
                }
            }
            else
            {   $msg = "Invalid Email";
                $msgClass = "alert-danger";
            }
            $user->close();
        }
        else
        {
            $msg = "All fields have to be filled";
            $msgClass = "alert-danger";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/main.css">
	<style>
		
		.box{
			position: relative;
			padding: 0px;
			min-height: 90vh;
		}

		select{
			color: unset;
		}

		option{
			color: unset;
		}

	</style>
</head>
<body>
		<!-- Navigation -->
		<header>
            <div class="container-fluid fixed-top">
                <nav class="navbar navbar-expand-sm navbar-light">
					<a href="" class="navbar-brand mx-auto">
                        <img src="../assets/alumni.png" style = "height: 70px; width: 110px; object-fit: cover">
                    </a>
                </nav>
            </div>
        </header>
		<!-- End Navigation -->

		<!-- Login & Signup -->
			<div class="container-fluid box">
				<form class="form-container" method="POST" action = <?php $_SERVER['PHP_SELF'] ?>>
					<ul class="tabs">
						<li data-tab-target="#register" class="tab">Register Now</li>
						<li data-tab-target="#login" class="active tab">Login</li>
					</ul>
					<div class="tab-content">
						<div id="register" data-tab-content>
						  
						  <div class="form-group" id="useradmin">
						  	
							<select class="form-control" id="selection" name="type">
								<option value="user">User</option>
								<option value="admin">Admin</option>
							</select>
						  </div>
						  
						  <div id="user" class="selected">	
							<div class="form-group">
								<!-- <label>Full Name</label> -->
								<input type="text" name="name" placeholder="Full Name">
							</div>
							<div class="form-group">
								<!-- <label>Email address</label> -->
								<input type="email" name="email" placeholder="Enter email">
							</div>
							<div class="form-group">
								<!-- <label>Phone Number</label> -->
								<input type="text" name="phoneno" placeholder="Phone Number">
							</div>

							
							<div class="form-group" id="useradmin">
						  	
							<select class="form-control" id="selection" name="course">
								<option value=0>Course</option>
								<option value=1>B.E</option>
								<option value=2>B.Tech</option>
								<option value=3>B.Arch</option>
							</select>
						  	</div>

						  	<div class="form-group" id="useradmin">
							<select class="form-control" id="selection" name="dept">
								<option value=0>Department</option>
								<option value=1>Computer Science and Engineering</option>
								<option value=2>Information Technology</option>
								<option value=3>Electronics and Communication</option>
								<option value=4>Mechanical Engineering</option>
								<option value=5>Electrics and Electronics</option>
								<option value=6>Aeronautical</option>
							</select>
						  	</div>

							<div class="form-group" id="useradmin">
						  	
							<select class="form-control" id="selection" name="college">
								<option value=0>College</option>
								<option value=1>Panimalar Engineering college</option>
								<option value=2>Rajalakshmi Engineering College</option>
								<option value=3>Sri Venkateshwara College</option>
							</select>
						  	</div>
							<div class="form-group" id="useradmin">
						  	
							<select class="form-control" id="selection" name="batch">
								<option value=0>Batch</option>
								<option value=1>2017</option>
								<option value=2>2018</option>
								<option value=3>2019</option>
							</select>
						  </div>
							<div class="form-group">
								<!-- <label>Password</label> -->
								<input type="password" id="inputPassword" placeholder="Password" name="pass">
							</div>
							<button type="submit" class="btn btn-primary" formaction="reg.php" name="user" value="ha">Register</button>
						  </div>

						  <div id="admin" class="selected">	
							<div class="form-group">
								<!-- <label>Full Name</label> -->
								<input type="text" name="college_name" placeholder="College Name">
							</div>
							<div class="form-group">
								<!-- <label>Email address</label> -->
								<input type="email" name="email" placeholder="Enter email">
							</div>
							<div class="form-group">
								<!-- <label>Phone Number</label> -->
								<input type="text" name="phoneno" placeholder="Phone Number">
							</div>
							<div class="form-group">
								<!-- <label>Password</label> -->
								<input type="password" id="inputPassword" placeholder="Password" name="pass">
							</div>
							<button type="submit" class="btn btn-primary" formaction="reg.php" name="user">Register</button>
						  </div>

						</div>
						<div id="login" data-tab-content class="active">
							<div class="form-group">
								<!-- <label>Email address</label> -->
								<input type="email" name="loginEmail" placeholder="Enter email">
							  </div>
							  <div class="form-group">
								<!-- <label>Password</label> -->
								<input type="password" name="loginPwd" placeholder="Password">
							  </div>
							  <div class = "alert <?php echo $msgClass ?>"><?php echo $msg ?></div>
							  <button type="submit" class="btn btn-primary" formaction = <?php $_SERVER['PHP_SELF'] ?>>Login</button>
						</div>
					</div>
				</form>
			</div>
			

		<!-- End Login & Signup -->
		<footer>
            <div class="container-fluid ">
                <div class="footer">
                    <p>Alumni connect site of <b>Rajalakshmi Engineering College</b></p>
                    <p class="ml-auto">&copy Designed by the students of <b>Computer Science & Engineering</b></p>
                </div>
            </div>
        </footer>

</body>

<script type="text/javascript">
	const tabs = document.querySelectorAll('[data-tab-target]');
	const tabContents = document.querySelectorAll('[data-tab-content]');

	tabs.forEach(tab => {
		tab.addEventListener('click', () => {
			const target = document.querySelector(tab.dataset.tabTarget);
			tabContents.forEach( tabContent => {
				tabContent.classList.remove('active');
			})
			tabs.forEach( tab => {
				tab.classList.remove('active');
			})
			tab.classList.add('active');
			target.classList.add('active');
		})
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){

	//hides dropdown content
	$(".selected").hide();

	//unhides first option content
	$("#user").show();

	//listen to dropdown for change
	$("#selection").change(function(){
	//rehide content on change
	$('.selected').hide();
	//unhides current item
	$('#'+$(this).val()).show();
	});

});
</script>
</html>