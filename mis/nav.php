  <?php


  $nname = $_SESSION['name'];
  $llevel = $_SESSION['level'];
  $username = $_SESSION['username'];
  // echo $username;

  $sqlLevel = "select level from user where username='$username'";
  $resultLevel = mysqli_query($con, $sqlLevel);
  while ($field = mysqli_fetch_assoc($resultLevel)) {
    $level = $field["level"];
    $_SESSION['level'] = $level;



    if ($_SESSION['level'] == 'admin') {
      $sql = "select * from request where status2='head'";
      // $sql="select * from request";
      $result = mysqli_query($con, $sql);
      $counthead = mysqli_num_rows($result);
    }


    if ($_SESSION['level'] == 'admin') {
      $sql = "select * from request where status2='admin'";
      // $sql="select * from request";
      $result = mysqli_query($con, $sql);
      $countadmin = mysqli_num_rows($result);
    }

    if ($_SESSION['level'] == 'head') {
      $sql = "select * from request where status2='head' and approving_head='$nname'";
      $result = mysqli_query($con, $sql);
      $counthead = mysqli_num_rows($result);
    }
  }
  if (isset($_POST['monthlyReport'])) {
    $_SESSION['month'] = $_POST['month'];
    $_SESSION['year'] = $_POST['year'];

  ?>
    <script type="text/javascript">
      window.open('../Monthly Report.php', '_blank');
    </script>
  <?php

  }
  if (isset($_POST['registerUser'])) {
    $userEmployeeId = $_POST['userEmployeeId'];
    $userFullName = $_POST['userFullName'];
    $userEmail = $_POST['userEmail'];
    $userDepartment = $_POST['userDepartment'];
    $userType = $_POST['userType'];

    $sql = "INSERT INTO `user`(`username`, `password`, `name`, `department`, `email`, `level`,`updatedEmail`) VALUES ('$userEmployeeId','$userEmployeeId','$userFullName','$userDepartment','$userEmail','$userType','1')";
    $results = mysqli_query($con, $sql);
  }



  require_once '../changePassword.php';
  $username = $_SESSION['username'];
  ?>


  <nav class="drop-shadow-md  bg-white px-2 sm:px-4 py-2 dark:bg-gray-800 fixed w-full z-20 top-0  left-0 border-b border-gray-200 dark:border-gray-900">

    <div class="flex items-center">

      <span id="sidebarButton" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation" class="block lg:hidden mx-10  dark:text-white">
        <i class="fa-solid fa-bars fa-lg"></i>

      </span>
      <span id="sidebarButton" type="button" onclick="shows()" class="hidden lg:block mx-10  dark:text-white">
        <i class="fa-solid fa-bars fa-lg"></i>

      </span>
      <a class="flex items-center">
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Helpdesk</span>
      </a>
      <div class="flex items-center order-2">
        <a href="ticketForm.php" type="button" class=" hidden lg:block text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mx-3 md:mx-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create a Ticket</a>

        <a data-modal-target="registerModal" data-modal-toggle="registerModal" type="button" class="hidden lg:block text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mx-3 md:mx-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</a>

        <a data-modal-target="reportModal" data-modal-toggle="reportModal" type="button" class="hidden lg:block text-white bg-gradient-to-r from-purple-400 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mx-3 md:mx-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Monthly Report</a>

        <a href="jo-form.php" type="button" class=" hidden lg:block text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mx-3 md:mx-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Request Job Order</a>
        <button type="button" class="flex mr-3 text-sm bg-white rounded-full sm:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
          <!-- <img class="w-8 h-8 rounded-full" src="../src/Photo/<?php echo $username; ?>.png" alt="user photo"> -->

          <?php
          $username = $_SESSION['username'];
          $first_two_letters = substr($username, 0, 2);
          // echo $username;
          if ($first_two_letters != "GP") {
            $imageFileName = '../src/Photo/' . $username . '.png';
            if (file_exists($imageFileName)) {
              $imageUrl = "url('$imageFileName')";
            } else {
              // Use default image if the file doesn't exist
              $imageUrl = "url('../src/Photo/default.png')";
            }
          ?> <div class="w-10 h-10 rounded-full  ">
              <div class="rounded-full h-full w-full" style="background-color: #C5957F; background-size: cover; background-image: <?php echo $imageUrl; ?>"></div>

            </div>
          <?php
          } else {
          ?>
            <div class="w-10 h-10 rounded-full  " style="
      padding-right: 10px;">
              <div class="rounded-full h-full w-full mr-5" style="background-color: #C5957F;width: 125%; background-size: cover; background-image: url('../src/Photo/<?php echo $username; ?>.png')"></div>

            </div>
          <?php
          }

          ?>



        </button>
        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
          <div class="px-4 py-3">
            <span class="block text-sm text-gray-900 dark:text-white "><?php echo $_SESSION['name'] ?></span>
            <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400"><?php echo $_SESSION['email'] ?></span>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            <!-- <li>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
            </li> -->

            <!-- <a data-modal-target="registerModal" data-modal-toggle="registerModal" type="button" class="hidden lg:block text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mx-3 md:mx-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</a>

  <a data-modal-target="reportModal" data-modal-toggle="reportModal" type="button" class="hidden lg:block text-white bg-gradient-to-r from-purple-400 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mx-3 md:mx-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Monthly Report</a> -->

            <li class="block lg:hidden">
              <a data-modal-target="registerModal" data-modal-toggle="registerModal" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Register</a>
            </li>
            <li class="block lg:hidden">
              <a data-modal-target="reportModal" data-modal-toggle="reportModal" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Monthly Reports</a>
            </li>
            <li>
              <a data-modal-target="holidaysModal" data-modal-toggle="holidaysModal" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Add Holidays</a>
            </li>
            <li>
              <a data-modal-target="changePassword" data-modal-toggle="changePassword" type="button" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Change Password</a>
            </li>
            <li>
              <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
            </li>

          </ul>
        </div>
        <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <!-- <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> -->
        </button>
      </div>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <!-- <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> -->
      </button>



      <div class="container flex flex-wrap justify-between items-center mx-auto pt-0 pl-4">


        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <!-- <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg> -->
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">

        </div>

        <div>


          </a>


        </div>
      </div>


      <!-- darkmode button -->



    </div>







  </nav>

  <!-- drawer component -->
  <div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-96 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
    <div class="mb-5">
      <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Helpdesk</h5>
      <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
      </button>

    </div>

    <div class="px-4">
      <div class="overflow-hidden flex bg-white overflow-visible relative max-w-sm mx-auto bg-white shadow-lg ring-1 ring-black/5 rounded-xl flex items-center gap-6 dark:bg-slate-800 dark:highlight-white/5">
        <!-- <img class="bg-blue-900 absolute -left-6 w-24 h-24 rounded-full shadow-lg" src="../src/Photo/<?php echo $username; ?>.png" > -->
        <?php

        $first_two_letters = substr($username, 0, 2);
        if ($first_two_letters != "GP") {
          $imageFileName = '../src/Photo/' . $username . '.png';

          // Check if the file exists
          if (file_exists($imageFileName)) {
            $imageUrl = "url('$imageFileName')";
          } else {
            // Use default image if the file doesn't exist
            $imageUrl = "url('../src/Photo/default.png')";
          }
        ?> <div class=" absolute -left-6 w-24 h-24 rounded-full shadow-lg">

            <div class="rounded-full h-full w-full  mr-10" id="picture" style="background-color: #C5957F; background-size: cover; background-image: <?php echo $imageUrl; ?>"></div>
          </div>
        <?php
        } else {
        ?>
          <div class=" absolute -left-6 w-24 h-24 rounded-full shadow-lg" style="">

            <div class="rounded-full h-full w-full  mr-10" id="picture" style="background-color: #C5957F;width: 125%; background-size: cover; background-image: url('../src/Photo/<?php echo $username; ?>.png')">
            </div>
          </div>
        <?php
        }

        ?>

        <div class="overflow-hidden flex flex-col py-2 pl-24">
          <strong class="text-slate-900 text-sm font-medium dark:text-slate-200 truncate  whitespace-nowrap"><?php echo $_SESSION['name'] ?></strong>
          <span class="text-slate-500 text-sm font-medium dark:text-slate-400 truncate  whitespace-nowrap"><?php echo $_SESSION['email'] ?></span>
          <span class="text-slate-500 text-sm font-medium dark:text-slate-400"><?php echo $_SESSION['department'] ?></span>

        </div>
      </div>
    </div>
    <!-- <button type="button"onclick="shows()"  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Close menu</span>
      </button> -->
    <div class="py-5 pr-5 overflow-y-auto">
      <ul class="space-y-2">
        <li>
          <a href="index.php" id="sidehome1" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
            <!-- <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg> -->
            <i class="fa-solid fa-house"></i>
            <span class="ml-3">Home</span>
          </a>
        </li>
        <li>
          <a href="myRequest.php" id="sideMyRequest1" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
            <!-- <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg> -->
            <i class="fa-solid fa-ticket"></i>
            <span class="ml-3">My Request</span>
          </a>
        </li>
        <li>
          <a href="history.php" id="sidehistory1" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-clock-rotate-left"></i> <span class="flex-1 ml-3 whitespace-nowrap">History</span>
          </a>
        </li>
        <li>
          <a href="user.php" id="sideuser1" class="   flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-user"></i> <span class="flex-1 ml-3 whitespace-nowrap">User</span>
          </a>
        </li>
        <li>
          <a href="pms.php" id="sidepms1" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-broom"></i> <span class="flex-1 ml-3 whitespace-nowrap">PMS</span>
          </a>
        </li>
        <li>
          <a href="devices.php" id="sidedevice1" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-computer"></i> <span class="flex-1 ml-3 whitespace-nowrap">Devices</span>
          </a>
        </li>
        <li>
          <a href="documents.php" id="sidedocs1" class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-file"></i> <span class="flex-1 ml-3 whitespace-nowrap">Documents</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <!-- side bar drawer component -->
  <div id="sidebar" class="hidden lg:block mt-2 fixed top-16 left-0 z-40 h-screen p-4 pr-0 overflow-y-auto transition-transform bg-white w-80 dark:bg-gray-700 transform-none" tabindex="-1" aria-labelledby="sidebar-label" aria-modal="true" role="dialog">

    <div class="px-4">
      <div class="overflow-hidden flex bg-white overflow-visible relative max-w-sm mx-auto bg-white shadow-lg ring-1 ring-black/5 rounded-xl flex items-center gap-6 dark:bg-slate-800 dark:highlight-white/5">
        <!-- <img class="bg-blue-900 absolute -left-6 w-24 h-24 rounded-full shadow-lg" src="../src/Photo/<?php echo $username; ?>.png" > -->
        <?php
        $first_two_letters = substr($username, 0, 2);
        if ($first_two_letters != "GP") {
          $imageFileName = '../src/Photo/' . $username . '.png';

          // Check if the file exists
          if (file_exists($imageFileName)) {
            $imageUrl = "url('$imageFileName')";
          } else {
            // Use default image if the file doesn't exist
            $imageUrl = "url('../src/Photo/default.png')";
          }
        ?>
          <div class="profile_pic absolute -left-6 w-24 h-24 rounded-full shadow-lg">
            <div class=" picture-container rounded-full h-full w-full  mr-10" id="picture" style="background-color: #C5957F; background-size: cover; background-image: <?php echo $imageUrl; ?>"></div>
            <label for="fileInput" style="cursor: pointer;">
              <i class="picbg fa-solid fa-camera"></i>
            </label>
            <input type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(this)">
          </div>
        <?php
        } else {
        ?>
          <div class="profile_pic absolute -left-6 w-24 h-24 rounded-full shadow-lg" style="
      padding-right: 20px;">

            <div class="picture-container rounded-full h-full w-full  mr-10" id="picture" style="background-color: #C5957F;width: 125%; background-size: cover; background-image: url('../src/Photo/<?php echo $username; ?>.png')">
              <label for="fileInput" style="cursor: pointer;">
                <i class="picbg fa-solid fa-camera"></i>
              </label>
              <input type="file" id="fileInput" style="display: none;" onchange="handleFileUpload(this)">
            </div>
          </div>
        <?php
        }

        ?>

        <div class="overflow-hidden flex flex-col py-2 pl-24">
          <strong class="text-slate-900 text-sm font-medium dark:text-slate-200 truncate  whitespace-nowrap"><?php echo $_SESSION['name'] ?></strong>
          <span class="text-slate-500 text-sm font-medium dark:text-slate-400 truncate  whitespace-nowrap"><?php echo $_SESSION['email'] ?></span>
          <span class="text-slate-500 text-sm font-medium dark:text-slate-400"><?php echo $_SESSION['department'] ?></span>

        </div>
      </div>
    </div>
    <!-- <button type="button"onclick="shows()"  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Close menu</span>
      </button> -->
    <div class="py-5 pr-5 overflow-y-auto">
      <ul class="space-y-2">
        <li>
          <a href="index.php" id="sidehome" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
            <!-- <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg> -->
            <i class="fa-solid fa-house"></i>
            <span class="ml-3">Home</span>
          </a>
        </li>
        <li>
          <a href="myRequest.php" id="sideMyRequest" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
            <!-- <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg> -->
            <i class="fa-solid fa-ticket"></i>
            <span class="ml-3">My Request</span>
          </a>
        </li>
        <li>
          <a href="history.php" id="sidehistory" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-clock-rotate-left"></i> <span class="flex-1 ml-3 whitespace-nowrap">History</span>
          </a>
        </li>
        <li>
          <a href="user.php" id="sideuser" class="   flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-user"></i> <span class="flex-1 ml-3 whitespace-nowrap">User</span>
          </a>
        </li>
        <li>
          <a href="pms.php" id="sidepms" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-broom"></i> <span class="flex-1 ml-3 whitespace-nowrap">PMS</span>
          </a>
        </li>
        <li>
          <a href="devices.php" id="sidedevice" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-computer"></i> <span class="flex-1 ml-3 whitespace-nowrap">Devices</span>
          </a>
        </li>
        <li>
          <a href="documents.php" id="sidedocs" class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

            <i class="fa-solid fa-file"></i> <span class="flex-1 ml-3 whitespace-nowrap">Documents</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <div id="changePassword" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button" data-modal-toggle="changePassword" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="px-6 py-6 lg:px-8">
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Change your password</h3>
          <form class="space-y-6" action="" method="POST">
            <input type="text" class="hidden" name="usernameChangePassword" value="<?php echo $_SESSION['username']; ?>">
            <div>
              <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your current password</label>

              <div>
                <input type="text" name="currentPass" id="currentPass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
              </div>
            </div>
            <div>
              <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your new password</label>

              <div>
                <input type="password" name="newPassword" id="newPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
              </div>
            </div>
            <div>
              <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Re-enter your new password</label>

              <div>
                <input type="password" name="retypePassword" id="retypePassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
              </div>
            </div>
            <button type="submit" name="submitNewPassword" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Update
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="reportModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button" data-modal-toggle="reportModal" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="px-6 py-6 lg:px-8">
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Choose month and year</h3>
          <form class="space-y-6" action="" method="POST">
            <div>
              <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Month</label>

              <select id="month" name="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                <?php
                $date = new DateTime('01-01-2023');
                $dateNow = new DateTime();
                $monthNow = $dateNow->format('F');

                for ($i = 1; $i <= 12; $i++) {
                  $month = $date->format('F');
                ?> <option <?php if ($monthNow == $month) {
                              echo "selected";
                            } ?> value="<?php echo $month; ?>"><?php echo $month; ?></option> <?php
                                                                                              $date->modify('next month');
                                                                                            }
                                                                                              ?>
              </select>

            </div>
            <div>
              <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
              <input type="number" value="<?php $dateNow2 = new DateTime();
                                          $year = $dateNow2->format('Y');
                                          echo $year; ?>" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>

            <button type="submit" name="monthlyReport" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Generate
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>


  <div id="holidaysModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full  max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button" data-modal-toggle="holidaysModal" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="px-6 py-6 lg:px-8">
          <div class="container mx-auto p-4">
            <h1 class="text-3xl font-semibold mb-4">Responsive Calendar</h1>
            <div class="flex justify-between mb-4">
              <button id="prevMonth" class="px-4 py-2 bg-blue-500 text-white rounded">Previous Month</button>
              <button id="nextMonth" class="px-4 py-2 bg-blue-500 text-white rounded">Next Month</button>
            </div>
            <div class="flex items-center mb-2">
              <span id="currentMonthYear" class="text-lg font-semibold"></span>
            </div>
            <div class="grid grid-cols-7 mb-2">
              <div class="calendar-header align-center">Mon</div>
              <div class="calendar-header align-center">Tue</div>
              <div class="calendar-header align-center">Wed</div>
              <div class="calendar-header align-center">Thu</div>
              <div class="calendar-header align-center">Fri</div>
              <div class="calendar-header saturday align-center">Sat</div>
              <div class="calendar-header sunday align-center">Sun</div>
            </div>
            <div class="grid grid-cols-7" id="calendar">
              <!-- Calendar content will be generated here -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="registerModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button" data-modal-toggle="registerModal" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="px-6 py-6 lg:px-8">
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Register</h3>
          <form class="space-y-6" action="" method="POST">
            <div>
              <div>
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee ID</label>
                <input type="text" name="userEmployeeId" id="userEmployeeId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
              </div>
              <div>
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="userFullName" id="fullName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
              </div>
              <div>
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="userEmail" id="userEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
              </div>
              <label for="userDepartment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>

              <select id="userDepartment" name="userDepartment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                <?php

                $sql = "SELECT DISTINCT TRIM(department) AS department FROM user;";
                $result = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?> <option value="<?php echo $row['department']; ?>"><?php echo $row['department']; ?></option> <?php
                                                                                                              }

                                                                                                                ?>
              </select>
              <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>

              <select id="userType" name="userType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="user">Employee</option>
                <option value="head">Department Head</option>
                <option value="admin">Administrator</option>
                <option value="mis">ICT</option>
                <option value="fem">FEM</option>



              </select>

            </div>


            <button type="submit" name="registerUser" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Register
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    var username = "<?php echo $_SESSION['username']; ?>";

    function handleFileUpload(input) {
      // const fileInput = document.getElementById('fileInput');
      //   const file = fileInput.files[0];
      const file = input.files[0];
      if (file) {
        console.log(file);

        const formData = new FormData();
        formData.append('file', file);
        formData.append('username', username);
        fetch('uploadprofile.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Change the background image of the container
              document.getElementById('picture').style.backgroundImage = ''
              document.getElementById('picture').style.backgroundImage = `url('../src/Photo/<?php echo $username; ?>.png')`;
              console.log(data)
              // location.reload();
            } else {
              console.error('File upload failed');
            }
          })
          .catch(error => console.error('Error:', error));
      }
    }



    const calendarContainer = document.getElementById("calendar");
    const prevMonthButton = document.getElementById("prevMonth");
    const nextMonthButton = document.getElementById("nextMonth");
    const currentMonthYearElement = document.getElementById("currentMonthYear");
    let currentDate = new Date(); // Current date
    let holidays = []; // Initialize an array to store holiday dates


    // Make an XMLHttpRequest to fetch holiday data
    var xhr1 = new XMLHttpRequest();
    xhr1.onreadystatechange = function() {
      if (xhr1.readyState === XMLHttpRequest.DONE) {
        if (xhr1.status === 200) {
          holidays = JSON.parse(xhr1.responseText);

          // Call the function to generate the calendar after fetching holiday data
          generateCalendar();
        } else {
          console.log("Error: " + xhr1.status);
        }
      }
    };
    xhr1.open("GET", "getHolidays.php", true);
    xhr1.send();


    function generateCalendar() {
      calendarContainer.innerHTML = ""; // Clear the calendar content

      // Get the current month and year
      const currentMonth = currentDate.toLocaleString('default', {
        month: 'long'
      });
      const currentYear = currentDate.getFullYear();
      currentMonthYearElement.textContent = `${currentMonth} ${currentYear}`;
      const today = new Date();
      const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
      const dayOfWeek = firstDayOfMonth.getDay(); // 0 for Sunday, 1 for Monday, ...
      const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
      for (let i = 1, a = 1; i <= daysInMonth; i++, a++) {
        if (a <= new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate()) {


          const dayOfWeekNumber = (dayOfWeek + i - 1) % 7;
          if (a == 7) {
            a = 0;
          }
          if (dayOfWeekNumber != a) {
            i--;
            const isSaturday = dayOfWeekNumber === 6;
            const isSunday = dayOfWeekNumber === 0;
            const isHoliday = holidays.find(holiday => holiday.holidaysDate === `${currentDate.getFullYear()}-${(currentDate.getMonth() + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`);
            const dayClasses = "calendar-day" +
              (isSaturday ? " saturday" : "") +
              (isHoliday ? " holiday" : "") +
              (isSunday ? " sunday" : "") +
              (today.getFullYear() === currentDate.getFullYear() && today.getMonth() === currentDate.getMonth() && today.getDate() === i ? " current-date" : "");
            const alignmentClass = dayOfWeekNumber === 1 ? 'align-left' :
              (dayOfWeekNumber === 0 ? 'align-right' : 'align-center');

            const dayElement = document.createElement("div");
            dayElement.className = `${dayClasses} ${alignmentClass}`;
            dayElement.textContent = " ";
            calendarContainer.appendChild(dayElement);
          } else {
            console.log("true");
            const isSaturday = dayOfWeekNumber === 6;
            const isSunday = dayOfWeekNumber === 0;
            const isHoliday = holidays.find(holiday => holiday.holidaysDate === `${currentDate.getFullYear()}-${(currentDate.getMonth() + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`);
            const dayClasses = "calendar-day" +
              (isSaturday ? " saturday" : "") +
              (isSunday ? " sunday" : "") +
              (isHoliday ? " holiday" : "") +
              (today.getFullYear() === currentDate.getFullYear() && today.getMonth() === currentDate.getMonth() && today.getDate() === i ? " current-date" : "");
            const alignmentClass = dayOfWeekNumber === 1 ? 'align-left' :
              (dayOfWeekNumber === 0 ? 'align-right' : 'align-center');

            const dayElement = document.createElement("div");
            dayElement.className = `${dayClasses} ${alignmentClass}`;
            dayElement.textContent = i;
            calendarContainer.appendChild(dayElement);

            dayElement.addEventListener("click", () => {
              // Handle the click event for this box
              const selectedDate = `${currentDate.getFullYear()}-${(currentDate.getMonth() + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;

              var addHoliday = new XMLHttpRequest();
              addHoliday.open("POST", "addHoliday.php", true);
              addHoliday.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              addHoliday.onreadystatechange = function() {
                if (addHoliday.readyState === XMLHttpRequest.DONE) {
                  if (addHoliday.status === 200) {
                    // Update was successful
                    message = JSON.parse(addHoliday.responseText);

                    console.log(addHoliday);

                    var message = JSON.parse(addHoliday.responseText);

                    // Display the message in an alert
                    alert(message.message);

                    if (message.message === "Date added to the database successfully") {
                      dayElement.classList.add("holiday");
                      // Update the box's class to indicate it's a holiday
                    } else if (message.message === "Date removed to the database successfully") {
                      dayElement.classList.remove("holiday");

                    }

                  } else {
                    console.log("Error: " + addHoliday.status);
                  }
                }
              };

              // Construct the data to be updated
              var data = "date=" + encodeURIComponent(selectedDate);

              // Add any other parameters needed for the update

              addHoliday.send(data);





            });

          }

        }
      }
    }


    generateCalendar(); // Initial calendar generation

    prevMonthButton.addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() - 1);
      generateCalendar();
    });

    nextMonthButton.addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() + 1);
      generateCalendar();
    });
  </script>
  <script>
    function clickButton() {
      var button = document.getElementById("sidebarButton"); // replace "myButton" with the ID of your button
      button.click();
    }

    function mouseOver() {
      document.getElementById("loginicon").style.display = "inline";
      document.getElementById("logintext").style.display = "none";

    }

    function mouseOut() {
      document.getElementById("logintext").style.display = "inline";
      document.getElementById("loginicon").style.display = "none";

    }



    //   var homeoption = document.getElementById("homeoption");
    //   homeoption.classList.remove("text-gray-700");
    //   homeoption.classList.add("text-white");
    //   homeoption.classList.remove("dark:text-gray-400");
    //   homeoption.classList.add("dark:text-white");
  </script>