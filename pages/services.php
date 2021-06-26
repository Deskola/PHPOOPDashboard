<?php
  include '../controller/pagination.php';
  $service = new Pagination('subservice');
  $pages  = $service->get_pagination_number(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">    
    <link rel="stylesheet" type="text/css" href="../assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/customfiles/dashstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/customfiles/snack.css">
    <title></title>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      table{
        
        table-layout:fixed;
      }
      table td {        
        word-wrap:break-word;
        width:100%; 
      }

      /* Pagination links */
      .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
      }

      /* Style the active/current link */
      .pagination a.active {
        background-color: dodgerblue;
        color: white;
      }

      /* Add a grey background color on mouse-over */
      .pagination a:hover:not(.active) {background-color: #ddd;}

      .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
      }

      .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
      }

      .closebtn:hover {
        color: black;
      }
    </style>
     
    <script type="text/javascript">
      function myFunc() {
        var x = document.getElementsByClassName("alertMsg");
       //this.parentElement.style.display='none';
       x.style.display='none';
      }
    </script>
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">iPay Africa</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form class="form-inline" style="width: 90%; display: flex;" action="searchResults.php" method="POST">
        <input class="form-control mr-sm-2" type="search" name="solution_search" placeholder="Search" aria-label="Search">
        <button class="btn bg-light float-end my-2 my-sm-0" name="seach_btn" type="submit" style="border-radius: 0 0 0 0;">
          <img src="../assets/images/search.png" alt="Search" width="30" height="30">
        </button>
      </form>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </header>

    <div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">
              <img src="../assets/images/dashboard.png" width="20" height="20" alt="customer">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <img src="../assets/images/solution.png" width="20" height="20" alt="customer">
              <span data-feather="file"></span>
              Solutions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <img src="../assets/images/services.png" width="20" height="20" alt="customer">
              <span data-feather="shopping-cart"></span>
              iPay Services
            </a>
          </li>          
        </ul>       
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Services</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#childService">New Child Service</button>
          </div>
          <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">New Main Service</button>          
        </div>
      </div>

       <!-- <h2>Main Service Categories</h2>

      <div class="table-responsive">
        <table class="table table-bordered table-dark table-sm">
          <thead>
            <tr>
              <th>Service name</th>
              <th>Description</th>              
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>           
          </tbody>
        </table>
      </div> -->

      <!-- Sub services tabe -->
      <h2>Sub Services Categories</h2>

       <div class="table-responsive">
        <table class="table table-bordered table-dark table-sm">
          <thead>
            <tr>
              <th>Service name</th>
              <th>Description</th>
              <th>Parent Service</th>              
              <!-- <th>Actions</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
              
              $solutions = $service->get_data();
              while ($row = mysqli_fetch_assoc($solutions)) {
                $mainServiceName = $service->readServiceById($row['serviceId']);
                //var_dump($mainServiceName);
                echo "<tr>";             
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["description"]."</td>";
                 echo "<td>".$mainServiceName["name"]."</td>";   
                // echo "<td><button class='btn btn-primary'>Details</button></td>";  
                echo "</tr>";  
              }
            ?> 
          </tbody>
        </table>

         <div class="pagination">
          <?php
            $prev = $service->prev_page();
            $next = $service->next_page();
            $check = $service->check_search();
             echo "<a href='?page=$prev'.''.$check>&laquo;</a>";
              for ($i=1; $i <= $pages; $i++) { 
                if ($service->is_showable($i)) {
                    $pagenum = $service->is_active_class($i);
                    echo "<a class='$pagenum' href='?page=$i'.''.$check'>
                      ".$i."
                    </a>";
                }
              }            
            echo "<a href='?page=$next'.''.$check>&raquo;</a>";
                
          ?>  
        </div>
      </div>
    </main>   
  </div>
</div>

 <?php
    if (isset($_GET['msg'])) {
      $message = $_GET['msg'];
      // $none = 'none';
      // echo "<div class='alertMsg alert'>";
      // echo '<span class="closebtn" onclick="myFunc()">&times;</span>';
      // echo "<strong>Danger!</strong>".$message;
      // echo "</div>";
      // echo "<div id='snackbar'>".$message."</div>";
      // echo "<script type='text/javascript'>",           
      //      "var x = document.getElementById('snackbar');"
      //         "x.className = 'show';"
      //         "setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);"
      //      "</script>";
      // ;     
    }
  ?>


<!-- New Service Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../controller/handlers/formSubmitHadler.php" method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Service Name:</label>
            <input type="text" required=""  class="form-control" id="service_name" name="service_name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" required=""  id="service_description" name="service_description"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="new_service" name="new_service" class="btn btn-primary">SUBMIT</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!-- New Sub Service Modal -->
<div class="modal fade" id="childService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../controller/handlers/formSubmitHadler.php" method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" required="" class="form-control" id="<!-- sub -->service_name" name="subservice_name">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Parent Service:</label>
            <select class="select" required=""  name="parent_service" id="parent_service" style="width: 100%;">
              <?php 
                
                $result = $service->readAllServices();
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" required=""  id="service_description" name="service_description"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="new_service" name="sub_service" class="btn btn-primary">SUBMIT</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>





    <script type="text/javascript" src="../assets/js/bootstrap.js"></script> 
    <script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>  
    <script type="text/javascript" src="../assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/select2.min.js"></script>    
    <script type="text/javascript">
       var snack = function() {
        console.log("here");
        // var x = document.getElementById("snackbar");
        // x.className = "show";
        // setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }

      function jsfunction(){
        console.log("here");
      }
    </script>
    <script type="text/javascript">

      var exampleModal = document.getElementById('exampleModal')
      exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalTitle.textContent = 'New message to ' + recipient
        modalBodyInput.value = recipient
      });

      $("#parent_service").select2();
     
    </script>


    
</body>
</html>