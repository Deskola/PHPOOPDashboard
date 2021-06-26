<?php
include '../controller/loggerController.php';
$service = new LoggerImp();
$conn = $service->dbConnect();

if (isset($_POST['seach_btn'])) {
   $searchWord = mysqli_escape_string($conn, $_POST['solution_search']);

    //var_dump([$name, $parentservice ,$description ]);   
    $results = $service->search($searchWord);    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">    
    <link rel="stylesheet" type="text/css" href="../assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/customfiles/dashstyle.css">
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

      .zoom {
        
        background-color: white;
        transition: transform .2s;
        width: 200px;
        height: 200px;
        margin: 0 auto;
      }

      .zoom:hover {
        -ms-transform: scale(1.5); /* IE 9 */
        -webkit-transform: scale(1.5); /* Safari 3-8 */
        transform: scale(1.5); 
      }

      .zoom .imageItem {
        background-size: cover;
      }
    </style>
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">iPay Africa</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form class="form-inline" style="width: 90%; display: flex;" action="" method="POST">
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
            <a class="nav-link" href="services.php">
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
        <h1 class="h2">Search Results...</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
          </div>         
          <!-- <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">New Solution</button -->
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
              // $searchResult = $service->search
              // if () {
              //   // code...
              // }

              // $solutions = $service->get_data();  
              while ($row = mysqli_fetch_assoc($results)) {
                $subservice = $service->getSubServiceName($row['subserviceid']);
                if (empty($subservice["name"])) {
                   $subservice["name"] = "UNKNOWN";
                }
                echo "<tr>";                
                echo "<td>".$row['title']."</td>";                
                echo "<td>".$row['problemDescription']."</td>";
                echo "<td>".$row['providesolution']."</td>";
                echo "<td>".$subservice['name']."</td>";
                echo "<td><button class='details btn btn-primary' id='".$row['id']."'>Details</button></td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
                     
      
    </main>
  </div>
</div>


<!-- New Service Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Solution</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="controller/handlers/formSubmitHadler.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Main Category:</label>
            <input type="text" class="form-control" id="main_service" name="main_service" required="">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Sub Category:</label>
            <input type="text" class="form-control" id="sub_service" name="sub_service" required="">
          </div>          
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Problem Description:</label>
            <textarea class="form-control" id="description" name="description" required=""></textarea>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Solution:</label>
            <textarea class="form-control" id="solution" name="solution" required=""></textarea>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Related Images:</label>
            <div id="inputFormRow"> 
            </div>

            <div id="newRow"></div>
            <button id="addRow" type="button" class="btn btn-info mt-3">Add Image</button>
          </div>
          <input type="text" hidden name="referenceNumber" value="<?php echo $ref ?>"/>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="new_solution" name="new_solution" class="btn btn-primary">SUBMIT</button>
          </div>          
        </form>
      </div>
      
    </div>
  </div>
</div> -->
<!-- Large model -->
<!-- ================================================================================================ -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Solution</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="controller/handlers/formSubmitHadler.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Title:</label>
            <input type="text" class="form-control form-control-sm" id="title" name="title" readonly="">
          </div>   
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Problem Description:</label>
            <textarea class="form-control" id="description" name="description" readonly=""></textarea>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Solution:</label>
            <textarea class="form-control" id="solution" name="solution" readonly=""></textarea>
          </div>       
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Sub Category:</label>
            <input type="text" class="form-control form-control-sm" id="sub_service" name="sub_service" readonly="">
          </div>          
          
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Related Images:</label>
            <ul class="imageGroup list-group list-group-horizontal" id="imageGroup">
              
            </ul>
            <!-- <div id="inputFormRow"> 
            </div>

            <div id="newRow"></div>
            <button id="addRow" type="button" class="btn btn-info mt-3">Add Image</button> -->
          </div>
          <input type="text" hidden name="referenceNumber" value="<?php echo $ref ?>"/>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <!-- <button type="submit" id="new_solution" name="new_solution" class="btn btn-primary">SUBMIT</button> -->
          </div>          
        </form>
      </div>      
    </div>
  </div>
</div>
<!-- ================================================================================================ -->
<script type="text/javascript" src="../assets/js/bootstrap.js"></script> 
<script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>  
<script type="text/javascript" src="../assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".details").click(function(){
      var button_id = $(this).attr('id');
      //console.log(button_id);
      $('#exampleModal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      });

      //console.log(data);

      $('#title').val(data[0]);
      $('#description').val(data[1]);
      $('#solution').val(data[2]);
      $('#sub_service').val(data[3]);

      //retrieve images
      $.ajax({
          url: '../controller/handlers/ajaxHandler.php',
          type: 'post',
          data: { field2: button_id},
          dataType: 'json',
          success: function(response){
            var len = response.length;
            // console.log(typeof(response));
            // console.log(len);
            //console.log(response);
            $('#imageGroup').empty();
              for (var i = 0; i < len; i++) {
                var id = response[i]['id'];
                var name = response[i]['name'];

                $('#imageGroup').append(
                    "<li class='zoom list-group-item '><img src='../uploads/"+name+"' width='100%' height='100%' class='imageItem'/></li>"
                    
                  );

              }
          },
          error: function (err) {
            console.log(err);
        }
      })
      
    });

    
  });
</script>
    
    
</body>
</html>