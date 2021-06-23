<?php
  include 'controller/pagination.php';
  $service = new Pagination('solution');
  $conn = $service->dbConnect();

  $pages  = $service->get_pagination_number();
  
  //var_dump($soln);

  if (isset($_POST['new_solution'])) {
      $title = mysqli_escape_string($conn, $_POST['title']);
      $subserviceid = mysqli_escape_string($conn, $_POST['subservice_name']);
      $problemDesc = mysqli_escape_string($conn, $_POST['description']);
      $solution = mysqli_escape_string($conn, $_POST['solution']);

      $results = $service->createSolution($title,$subserviceid,$problemDesc,$solution);
      if ($results) {          
        mysqli_close($conn);
      }else{
        echo "Failed";
      } 
      
  }
 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/customfiles/tabstyle.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/customfiles/dashstyle.css">
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
       /* border-collapse:collapse;*/ 
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
    </style>
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">iPay Africa</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
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
            <a class="nav-link active" aria-current="page" href="#">
            <img src="./assets/images/dashboard.png" width="20" height="20" alt="customer">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
            <img src="./assets/images/solution.png" width="20" height="20" alt="customer">
              <span data-feather="file"></span>
              Solutions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./pages/services.php">
            <img src="./assets/images/services.png" width="20" height="20" alt="customer">
              <span data-feather="shopping-cart"></span>
              iPay Services
            </a>
          </li>          
        </ul>       
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
          </div>         
          <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">New Solution</button>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-dark table-sm">
          <thead>
            <tr>
              <th>Title</th>
              <th>Problem</th>
              <th>Solution</th>
              <th>Service</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $solutions = $service->get_data();  
              while ($row = mysqli_fetch_assoc($solutions)) {
                $subservice = $service->getSubServiceName($row['subserviceid']);
                echo "<tr>";
                echo "<td>".$row['title']."</td>";                
                echo "<td>".$row['problemDescription']."</td>";
                echo "<td>".$row['solution']."</td>";
                echo "<td>".$subservice['name']."</td>";
                echo "<td><button class='btn btn-primary'>Details</button></td>";
                echo "</tr>";
              }
              // foreach ($solutions as $solution) {
              //   echo "<tr>";
              //   echo "<td>".$solution['title']."</td>"; 
              //   echo "</tr>";
              // }
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
            //echo "<a href='?page=$next'>&raquo;</a>";
            echo "<a href='?page=$next'.''.$check>&raquo;</a>";
                
          ?>  
        </div>
              
      
    </main>
  </div>
</div>


<!-- New Service Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Solution</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Service Name:</label>
            <select class="select" name="" id="service_name" required="">
              <option>- select -</option>
               <?php                 
                $result = $service->readAllServices();
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Sub Service Name:</label>
            <select class="select" name="subservice_name" id="subservice_name" required="">
                <option>- select -</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Problem Description:</label>
            <textarea class="form-control" id="description" name="description" required=""></textarea>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Solution:</label>
            <textarea class="form-control" id="solution" name="solution" required=""></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="new_solution" name="new_solution" class="btn btn-primary">SUBMIT</button>
          </div>          
        </form>
      </div>
      
    </div>
  </div>
</div>



    <script type="text/javascript" src="./assets/js/bootstrap.js"></script> 
    <script type="text/javascript" src="./assets/js/bootstrap.bundle.min.js"></script>  
    <script type="text/javascript" src="./assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="./assets/js/select2.min.js"></script>
    <script type="text/javascript" src="./assets/customfiles/tabjs.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#service_name').change(function(){
          var parentID = $(this).val();
          //console.log(parentID);

          $.ajax({
            url: 'controller/subServiceHandler.php',
            type: 'post',
            data: { field1: parentID},
            dataType: 'json',
            success: function(response){
              var len = response.length;
              // console.log(typeof(response));
              // console.log(len);
              $('#subservice_name').empty();
                for (var i = 0; i < len; i++) {
                  var id = response[i]['id'];
                  var name = response[i]['name'];

                  $('#subservice_name').append(
                      "<option value='"+id+"'>"+name+"</option>"
                    );

                }
            },
            error: function (err) {
              console.log(err);
          }
          });
        })
      });

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
    </script>
    
</body>
</html>