<!DOCTYPE html>
 <html>
 <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home Admin</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.tailwindcss.com"></script>
   <style>
  .card{
      background-color: whitesmoke;
      padding:20px;
      margin: 10px;
      border-radius: 10px;
      box-shadow: 8px 5px 5px #3B3131;
  }
  .card{
    display: flex;
    flex-direction: row;
  }
   </style>
 </head>
 <body class="px-0 mx-0">
  <div class="flex">
<div class="left " style="margin-left: -1%;"  >
<?php 
 include_once  ("../includes/navbar_admin.php");
 ?>
</div>

<div class="container w-75 py-4">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card row">
                <i class="fa fa-users mb-2" style="font-size: 50px;"></i>
                <h4 class="mt-4" style="color:black;">Total admins :hhhhhhh</h4>
                <h4 class="mt-4" style="color:black;">Total clients : hhhhhhhh</h4>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card row">
                <i class="fa fa-th-large mb-2" style="font-size: 50px;"></i>
                <h4 class="mt-4" style="color:black;"  class="" >Total Categories</h4>
                <h5 class="mt-4" style="color:black;"> hhhhhhhhhhhhh</h5>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card row">
                <i class="fa fa-th mb-2" style="font-size: 50px;"></i>
                <h4 class="mt-4" style="color:black;">Total Products</h4>
                <h5 class="mt-4" style="color:black;">hhhhhhhhhhh</h5>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card row">
                <i class="fa fa-list mb-2" style="font-size: 50px;"></i>
                <h4 class="mt-4" style="color:black;">Total Orders</h4>
                <h5 class="mt-4" style="color:black;">hhhhhhhh</h5>
            </div>
        </div>
    </div>
</div>

</div>
</div>
 </body>
 </html>