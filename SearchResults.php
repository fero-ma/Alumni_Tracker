<?php
    include_once('config/Database.php');
    include_once('models/UserDetails.php');
    include_once('models/College.php');
    include_once('models/Course.php');
    include_once('models/Batch.php');
    include_once('models/Department.php');

    $database = new Database();
    $db = $database->connect();

    $college = new College($db);
    $course = new Course($db);
    $batch = new Batch($db);
    $department = new Department($db);

    $colleges = $college->getAll();
    $courses = $course->getAll();
    $batches_from = $batch->getAll();
    $batches_to = $batch->getAll();
    $departments = $department->getAll();

    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();//start session if session not start
    }

    // if(!isset($_SESSION["user_id"])){
    //     header('location: login/index.php');
    // }

    // $user_id = $_SESSION['user_id'];
    // $role = $_SESSION['role'];
    // $fullname = $_SESSION['fullname'];
    // $image = $_SESSION['image'];

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
                    <!--  -->
        <title>SIHALumnus</title>

        <style>
            /* .container-fluid {
                width: 98%;
                padding: 0px;
            } */

            body {
                margin: 0px;
                padding-top: 120px;
                /* background-image: url('bg.jpeg');
                background-size: cover;
                background-repeat: no-repeat; */
                background-color: rgb(65,0,80);
                background-image: linear-gradient(180deg, rgb(65,0,80) 65%, #EEE 35%);
            }

            .navbar {
                box-shadow: 0 5px 5px -5px #888888;
                background-color: #FFF;
            }

            .nav-item {
                padding: 0px 16px;
                text-align: center;
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
                top: 100%;
            }

            .footer {
                background-color:rgb(65, 0, 80);
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

            .event-card {
                /* display:flex; */
                background-color: #EEE;
                width: 460px;
                min-height: 140px;
                border-style: none;
                border-left: 5px solid goldenrod;
                border-radius: 0%;
            }

            .recButton {
                border: 2px solid rgb(65, 0, 80);
                padding: 10px;
                background-color: transparent;
                cursor: pointer;
                text-align: center;
                margin-bottom: 20px;
                font-weight: bold;
            }

            .recButton:hover {
                background-color: #EEE;
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

            .container {
                padding: 20px;
                min-width: 80%;
                min-height: 84vh;
            }

            .search-box, .search-results{
                display: block;
                min-height: max-content;
                border: 1px solid grey;
                padding: 40px 40px 15px 40px;
                margin-bottom: 40px;
                width: 100%;
                background-color: #FFF;
                box-shadow: 0px 0px 10px #888;
            }

            .search-results{
                padding: 30px 45px;
            }

            .search-box h4{
                width: 50%;
                margin-bottom: 2em;
            }

            .form-control{
                min-width: 100%;
                padding: 25px;
                border-radius: 0;
            }

            .form-inline{
                position: relative;
            }

            .form-inline button{
                position: absolute;
                background-color: rgb(65,0,80);
                border: none;
                padding-right: 8px;
                border-radius: 0;
                height: 42px;
                top: 5px;
                right: 5px;
                transition: 0.3s;
            }

            .form-inline button:hover{
                background-color: rgb(65,0,80);
                transform: scale(0.9);
                filter: brightness(125%);
                transition: 0.3s;
            }

            .search-icon{
                font-size: 20px;
                vertical-align: text-bottom;
            }

            .card{
                border-radius: 0;
                padding: 5px;
                height: 95px;
                clear: both;
                /* border: 1px solid rgb(65,0,80); */
                transition: 0.2s;
            }

            .card:hover{
                transform: scale(1.04);
                box-shadow: 6px 7px 7px -7px #777;
                /* border: 1px solid rgb(65,0,80); */
                transition: 0.2s; 
            }
            

            .card .row .col a{
                color: unset;
            }

            .card img{
                display: block;
                float: left;
                width: 80px;
                height: 99%;
                object-fit: cover;
            }

            .info{
                display: block;
                float: left;
                padding: 3px;
            }

            .info p{
                margin: 1px 10px;
                font-size: 12px;
            }

            .info .fullname{
                font-weight: bold;
                font-size: 14px;
            }

            .search-count{
                font-size: 20px;
                margin: 0 10px;
                color: rgb(65, 0, 80);
                vertical-align:text-bottom;
            }

            .filters p{
                margin-top: 10px;
                margin-bottom: 0;
            }

            .search-results h4{
                margin-bottom: 20px;
            }

            .form-check-label{
                position: relative;
                cursor: pointer;
                margin: 0.4em 0.2em;
            }

            .filter-expansion{
                /* display: inline-block; */
                display: none;
                position: relative;
                /* width: max-content; */
                padding: 1em 0em 0 1em;
            }

            /* .filter-expansion::after{
                font-size: 20px;
                content: "/";
            } */

            .applied{
                display: inline-block;
            }

            input[type=text]{
                border: 1px solid rgb(65,0,80);
            }

            input[type=text]:focus{
                /* color */
            }

            select{
                /* margin: 1em 0em 0 0; */
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                background-color: rgb(65, 0, 80);
                border: 1px solid rgb(65, 0, 80);
                padding: 5px 7px 6px 7px;
                width: max-content;
                color: #EEE;
                outline: 0px;
            }

            .arrow-rev{
                display: inline-block;
                position: absolute;
                /* bottom: 1px;   */
                /* left: -18px; */
                left: -2px;
                width: 0; 
                height: 0; 
                border-top: 18px solid rgb(65, 0, 80);
                border-bottom: 18px solid rgb(65, 0, 80);
                border-right: 8px solid rgb(65, 0, 80);
                border-left: 16px solid transparent;
            }

            .arrow{
                display: inline-block;
                position: absolute;
                bottom: 0px;  
                right: -16px;
                width: 0; 
                height: 0; 
                border-top: 18px solid transparent;
                border-bottom: 18px solid transparent;
                border-left: 16px solid rgb(65, 0, 80);
            }

            .my-check{
                position: absolute;
                top: 7px;
                left: -2px;
                background-color: #CCC;
                width: 13px;
                height: 13px;
            }

            .my-checked{
                position: absolute;
                top: 1.5px;
                left: 1.5px;
                width: 10px;
                height: 10px;
            }

            input[type=checkbox]{
                visibility: hidden;
            }

            input[type=checkbox]:checked + .my-check .my-checked{
                background-color: rgb(65, 0, 80);
                transition: 0.2s;
            }

            input[type=checkbox]:checked + .my-check .my-checked{
                background-color: rgb(65, 0, 80);
                transition: 0.2s;
            }

            .applied-filters{
                margin-bottom: 1em;
            }

            .badge{
                margin-left: 0.6em;
                padding-top: 1px;
                padding-bottom: 5px;
                font-size: 13px;
                background-color: rgb(65, 0, 80);
                font-weight: 600;
                color: #EEE;
            }

            #loader{
                display: none;
            }

            .spinner-grow {
                display: block;
                color:rgb(65, 0, 80);
                margin: 0 auto;
            }

            .not-found{
                display: block;
                width: max-content;
                margin: 0 auto;
            }

            .not-found img{
                width: 250px;
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

            .start{
                text-align: center;
                color: rgb(65, 0, 80);
            }

            @media only screen and (max-width: 980px){
                .search-box h4{
                    width: 100%;
                    padding: inherit;
                }
                
                .search-box{
                    padding: 20px;
                }

                .search-results{
                    padding: 15px;
                }

                /* .filter-expansion{
                    padding-left: 20px;
                    border: 1px solid grey;
                }

                .arrow-rev{
                    margin-left: 20px
                } */
            }

            @media only screen and (max-width: 576px){
                
                body{
                    padding-top: 80px;
                }

            }

        </style>

        <script>

            $(document).ready(function() {

                var filters = [];
                var jsonFilters = {};

                $('input[type=checkbox]').change(function () {
                    var filter = $(this).attr("data-target");
                    var filter_name = filter.slice(1)

                    if(filter_name=='batch') {
                        var filter_val1 = $(filter).children('select').first().val(); 
                        var filter_val2 = $(filter).children('select').last().val(); 
                    }
                    else {
                        var filter_val = $(filter).children('select').val();
                    }

                    

                    if (!this.checked) {
                        $(filter).removeClass('applied');

                        // filters.splice( filters.indexOf(filter), 1 );;
                        if(filter_name == "batch") {
                            delete jsonFilters['from_year'];
                            delete jsonFilters['to_year'];
                        }
                        else
                            delete jsonFilters[filter_name];
                    } else { 
                        $(filter).addClass('applied');

                        // filters.push(filter_name)
                        if(filter_name == "batch") {
                            jsonFilters['from_year'] = filter_val1;
                            jsonFilters['to_year'] = filter_val2;
                        }
                        else
                            jsonFilters[filter_name] = filter_val;
                    }

                    console.log(jsonFilters);
                    search();

                });

                $('select').change(function() {
                    var filter_name = $(this).attr('name');
                    var filter_val = $(this).val();
                    jsonFilters[filter_name] = filter_val;
                    console.log(jsonFilters);
                    search();
                })

                $('input[type=text]').keyup( function() {
                    search();
                })

                function search() {
                    var query = $('input[type=text]').val();

                    if(query != '') {
                        $.ajax({
                            url: "models/search.php",
                            method: "post",
                            data: {
                                'query': query,
                                'filters': jsonFilters
                            },
                            dataType: "text",
                            // contentType: 'application/json',
                            beforeSend: function () {
                                $('#loader').fadeIn(200);
                            },
                            complete: function () {
                                $('#loader').stop().fadeOut(100);
                            },
                            success: function(data){
                                $('.search-results').html(data);
                            },
                            error: function(data){
                                console.log(data.responseText);
                            }
                        });
                    } else {
                        $('.search-results').html("<h2 class='start'>Enter a keyword to begin the search!</h2>");
                    }
                } 

            })

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
                                        <img class="rounded-circle" src="<?php echo $_SESSION["image"];?>">
                                        <p><?php echo $_SESSION["fullname"];?></p>
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

        <div class="container">
            <div class="search-box">
                <h4 class="mx-auto  text-center">Search for your friends, favourite seniors, & faculty and get in touch with them!</h4>
                    <form class="form-inline">
                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter name" id="pwd">
                        <button type="submit" class="btn btn-primary mb-2">Find <span class="material-icons search-icon">search</span></button>

                        <div class="filters">
                            <p class="text-left font-weight-bold">Filter by:</p>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" data-target="#college">College
                                  <span class="my-check"><span class="my-checked"></span></span>
                                </label>
                            </div>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" data-target="#course">Course
                                  <span class="my-check"><span class="my-checked"></span></span>
                                </label>
                            </div>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" data-target="#batch">Batch
                                  <span class="my-check"><span class="my-checked"></span></span>
                                </label>
                            </div>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" data-target="#department">Department
                                  <span class="my-check"><span class="my-checked"></span></span>
                                </label>
                            </div>
                            
                            <!-- =============================================== -->
                            
                            <div class="applied-filters">
                                <div id="college" class="filter-expansion">
                                    <span class="arrow-rev"></span>
                                    <select name="college">
                                        <?php 
                                            while($row = $colleges->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <option value="<?php echo $row["college_id"] ?>" ><?php echo $row["college_name"]?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="arrow"></span>
                                </div>
                                <div id="course" class="filter-expansion">
                                    <span class="arrow-rev"></span>
                                    <select name="course">
                                        <?php   
                                            while($row = $courses->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <option value="<?php echo $row["course_id"] ?>" ><?php echo $row["course_name"]?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="arrow"></span>
                                </div>
                                <div id="batch" class="filter-expansion">
                                    <span class="arrow-rev"></span>
                                    <select name="from_year">
                                        <?php   
                                            while($row = $batches_from->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <option><?php echo $row["from_year"]?></option>
                                        <?php } ?>
                                    </select>
                                    <select name="to_year" style="margin-left: -3px;">
                                        <?php   
                                            while($row = $batches_to->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <option><?php echo $row["to_year"]?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="arrow"></span>
                                </div>
                                <div id="department" class="filter-expansion">
                                    <span class="arrow-rev"></span>
                                    <select name="department">
                                        <?php   
                                            while($row = $departments->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                                <option value="<?php echo $row["dept_id"] ?>" ><?php echo $row["dept_name"]?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="arrow"></span>
                                </div>
                            </div>
                        
                        </div> 
                    </form>
                    
            </div>

            <!-- <div id="results"> -->
                <div class="search-results">
                    <!-- <h4 class="text-left" style="display: inline-block;">Search Results: </h4><span class="search-count">(9 matching profiles)</span>
                    <br> -->

                    <!-- <div class="not-found">
                        <img src="nousers.png" alt="NOT FOUND"/>
                    </div> -->

                    <!-- style="display: none;" -->

                    <div id="loader">
                        <span class="spinner-grow"></span>
                    </div>

                    <h2 class="start">
                        Enter a keyword to begin the search!
                    </h2>
                        

                </div>
            <!-- </div> -->
        </div>

    
            <!-- BUTTONS -->
    
            <!-- <div class="container">
                <a class="recButton">+ CREATE A NEW POST</a>
                <a class="backButton">&lt BACK TO RESULTS</a>
            </div>
    
            <div class="container">
                <div class="checkboxFour">
                    <input type="checkbox" value="1" id="checkboxFourInput" name="" />
                    <label for="checkboxFourInput"></label>
                    <p>Batch</p>
                </div>
            </div> -->

        <!-- FOOTER -->

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