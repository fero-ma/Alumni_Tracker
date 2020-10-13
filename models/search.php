<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');

    include_once('../config/Database.php');
    include_once('../models/UserDetails.php');

    $database = new Database();
    $db = $database->connect();

    $user = new UserDetails($db);

    $request = $_SERVER['REQUEST_METHOD'];

    $output =   '';


    if($request == "POST") {

        $result = $user->readAll($_REQUEST["query"], $_REQUEST);

        if($result->rowCount() > 0) {
            $output .= '
                                <h4 class="text-left" style="display: inline-block;">Search Results: </h4><span class="search-count">('.$result->rowCount().' matching profiles)</span>
                                <br>

                                <div class="card-columns">
                        ';

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $output .= '
                                    <div class="card">
                                        <div class="row">
                                            <div class="col">
                                                <img src="'.$image.'" />
                                                <a class="stretched-link" href="profilepage.php?email='.$email.'">
                                                    <div class="info">
                                                        <p class="fullname">'.$fullname.'</p>
                                                        <p>'.$designation.'</p>
                                                        <p>'.$employer_name.'</p>
                                                        <p>Batch of '.$from_year.' - '.$to_year.'</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            ';
                unset($row);
            }

            $output .= '       </div> 
                        '; //For the card-columns

            echo $output;
            
        } else {
            $output .= '    <div class="not-found">
                                <img src="nousers.png" alt="NOT FOUND"/>
                            </div>
                        ';
            echo $output;
        }
    }

?>