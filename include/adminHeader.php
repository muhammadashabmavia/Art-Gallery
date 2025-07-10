<?php
   session_start();
   include_once "./config/dbconnect.php";

?>
       
 <!-- nav -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
            <img src="./assets/images/logo.png" alt="aaru">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                
                <a class="nav-link" href="http://localhost/art/index.php" style="text-decoration:none;">
                            <i class="fa fa-sign-in me-3" style="font-size: 24px; color: #000;" aria-hidden="true"></i>
                        </a>
                    
                </li>
            </ul>
        </div>
    </div>
</nav>

