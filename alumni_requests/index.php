<?php
    include_once '../config/Database.php';


    $database = new Database();
    $conn = $database->connect();

    $query = "SELECT u.user_id, u.clg_rollno, u.fullname, b.from_year, b.to_year, d.dept_name, c.course_name, co.college_name 
              FROM user_details u LEFT JOIN departments d on u.dept_id = d.dept_id
              LEFT JOIN courses c on u.course_id = c.course_id
              LEFT JOIN colleges co on u.college_id = co.college_id
              LEFT JOIN batches b on u.batch_id = b.batch_id 
              where u.status = 'pending' ";

    $stmt = $conn->prepare($query);
    // $stmt->bindParam('1', "pending");
    $stmt->execute();

    $users = $stmt->fetchAll();
    $row = $stmt->rowCount();

    if(isset($_POST['val'])){
        if($_POST['res'] == "Accept"){
            $query1 = "UPDATE user_details SET status = 'ACCEPTED' WHERE user_id= '".$_POST['val']."'";
            $stmt1 = $conn->prepare($query1);
            // $stmt1->bindParam('1', $_POST['res']);
            $stmt1->execute();
            echo "hi";
        }
        elseif($_POST['res'] == "Decline"){
            $query1 = "UPDATE user_details SET status = 'DECLINED' WHERE user_id= '".$_POST['val']."'";
            $stmt1 = $conn->prepare($query1);
            // $stmt1->bindParam('1', $_POST['res']);
            $stmt1->execute();
            echo "hi";
        }
    }

?>


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
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
                    <!--  -->
        <title>Colleges</title>

        <style>
            /* .container-fluid {
                width: 100%;
                padding: 0px;
            } */

            body {
                margin: 0px;
                padding-top: 120px;
                min-height: 100vh;
                background-image: linear-gradient(180deg, rgb(65,0,80) 50%,#EEE 50%);
                /* background-color: #EEE; */
            }

            .navbar {
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
                border: 1px solid white;
                font-size: 75%;
                color: white;   
                padding: 20px 20px ;
                display: flex;
                position: relative;
                flex-direction: row;
                flex-wrap: wrap;
                /* position: relative; */
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

            h3 {
                /* border: 1px solid black; */
                text-align: center;
                padding: 30px;
            }

            h3 .nothing {
                min-height: 90vh;
            }
            /* Table */

            .bg {
                background-color: white;
                width:90%;
                margin: auto;
                min-height: 90vh
                /* border: 2px solid grey; */
                
            }

            table {
                border: 5px solid #000;
            }

            th {
                border-left: 1px solid #000;
            }

            /* th + th {
                border-left: 1px solid #000;
            } */

            tr {
                border-top: 1px solid #000;
            }

            /* tr + tr {
                border-top: 1px solid #000;
            } */

            td {
                border-left: 1px solid #000;
            }

            /* td + td {
                border-left: 1px solid #000;
            } */

            table {
                width: 90%;
                margin: auto;
                /* min-height: 90vh; */
                /* border: 5px solid black; */
            }

            /* table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                border-spacing: 0;
            } */

            th {
                font-weight: 700;
                text-align: center;
                padding: 25px 0;
                /* border-bottom: 1px solid black; */
            }

            td {
                font-weight: 500;
                text-align: center;
                padding: 25px 0;
                /* border-bottom: 1px solid black; */
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            } 
            

            /* .nothing {
                width:
                border: 3px solid black;
            } */

            /* End Table */

            @media only screen and (max-width: 980px){
            }

        </style>

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
                                <a class="nav-link" href="#">My Storyboard</a>
                            </li>
                        </ul>
                    </div>
                    <a href="" class="navbar-brand mx-auto">
                        <img src="../assets/alumni.png" style = "height: 40px; width: 150px; object-fit: cover">
                    </a>
                    <div class="collapse navbar-collapse" id="collapse">
                        <ul class = "navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="#login" class = "nav-link">
                                    <div class="my-profile">
                                        <img class="rounded-circle" src="profilepic.jpg">
                                        <p>Mark Ruffalo</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <div class="bg">
            <?php if($row > 0): ?>
                <h3>List of Students</h3>
                <table class="has" id="table">
                <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>From Year</th>
                    <th>To Year</th>
                    <th>Department</th>
                    <th>Course</th>
                    <th>College</th>
                    <th>Accept/Decline</th>
                </tr>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user['clg_rollno']; ?></td>
                            <td><?php echo $user['fullname']; ?></td>
                            <td><?php echo $user['from_year']; ?></td>
                            <td><?php echo $user['to_year']; ?></td>
                            <td><?php echo $user['dept_name']; ?></td>
                            <td><?php echo $user['course_name']; ?></td>
                            <td><?php echo $user['college_name']; ?></td>
                            <td><input type="hidden" class="u_id" id= "<?php echo $user['user_id']; ?>">
                            <input type=submit class="btn btn-success acc" value="Accept" id="<?php echo $user['clg_rollno']; ?>" name="acc">&nbsp
                            <input type="button" class="btn btn-danger dan" value="Decline" id="<?php echo $user['clg_rollno']; ?>" name="dec"></td>
                        </tr>

                    <?php endforeach; ?>
                <?php endif; ?>
                <!-- <tr>
                    <td>Dinesh</td>
                    <td>48</td>
                    <td>CSE</td>
                    <td>2017-2021</td>
                    <td>B.E</td>
                    <td><button class="btn btn-success">Accept</button>&nbsp<button class="btn btn-danger">Decline</button></td>
                </tr>
                <tr>
                    <td>Ajay</td>
                    <td>12</td>
                    <td>CSE</td>
                    <td>2017-2021</td>
                    <td>B.E</td>
                    <td><button class="btn btn-success">Accept</button>&nbsp<button class="btn btn-danger">Decline</button></td>    
                </tr>
                <tr>
                    <td>Ferose</td>
                    <td>55</td>
                    <td>CSE</td>
                    <td>2017-2021</td>
                    <td>B.E</td>
                    <td><button class="btn btn-success">Accept</button>&nbsp<button class="btn btn-danger">Decline</button></td>
                </tr> -->
            </table>
            <?php if($row == 0): ?>
                    <i class="far fa-thumbs-up"></i>
                    <h3 class="nothing">No new registrations.<br>You are all caught up!</h3>
            <?php endif; ?>
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

<script>
    $(document).ready(function(){
        $('.acc').click(function(){
            var val = $(".u_id").attr('id');
            var res = $(".acc").val();
            console.log(val);

            $.ajax({
                url: 'index.php',
                method: 'post',
                data: {res: res, val: val},
                success: function(data){
                    location.reload(data);
                }
            });
            
        });

        $('.dec').click(function(){
            var val = $(".u_id").attr('id');
            var res = $(".dec").val();
            console.log(val);

            $.ajax({
                url: 'index.php',
                method: 'post',
                data: {res: res, val: val},
                success: function(data){
                    location.reload(data);
                }
            });
            
        });
    });

</script>