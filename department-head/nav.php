<?php



$nname = $_SESSION['name'];
$llevel = $_SESSION['level'];
$username = $_SESSION['username'];


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


?>


<nav class="drop-shadow-md  bg-white px-2 sm:px-4 py-2 dark:bg-gray-900 fixed w-full z-20 top-0  left-0 border-b border-gray-200 dark:border-gray-600">

  <div class="flex items-center">


    <span id="sidebarButton" type="button" onclick="shows()" class="mx-10">
      <i class="fa-solid fa-bars fa-lg"></i>

    </span>
    <a class="flex items-center">
      <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Helpdesk</span>
    </a>
    <div class="flex items-center md:order-2">
      <?php
      $date = new DateTime();
      $dateToday = $date->format('d');
      if ($dateToday >= 28) {
      ?>
        <button data-modal-target="cut-off" data-modal-toggle="cut-off" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mx-3 md:mx-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
          Request Job Order
        </button>


      <?php

      } else {
      ?>
        <a href="jo-form.php" type="button" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mx-3 md:mx-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Request Job Order</a>

      <?php
      }
      ?>
      <button type="button" class="flex mr-3 text-sm bg-white rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <!-- <img class="w-8 h-8 rounded-full" src="../src/Photo/<?php echo $username; ?>.png" alt="user photo"> -->

        <?php

        $first_two_letters = substr($username, 0, 2);
        if ($first_two_letters != "GP" && $username != "lem") {
        ?> <div class="w-10 h-10 rounded-full  ">
            <div class="rounded-full h-full w-full" style="background-color: #C5957F; background-size: cover; background-image: url('../src/Photo/default.png')"></div>

          </div>
        <?php
        } else if ($username == "lem") {
        ?>
          <div class="w-10 h-10 rounded-full  " style="background-color: #C5957F;padding-top: 5px;
    padding-right: 10px;">
            <div class="rounded-full h-full w-full mr-5" style="background-color: #C5957F;width: 125%; background-size: cover; background-image: url('../src/Photo/<?php echo $username; ?>.png')"></div>

          </div>
        <?php
        } else {
        ?>
          <div class="w-10 h-10 rounded-full  " style="background-color: #C5957F;padding-top: 5px;
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
          </li>
          <li>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
          </li> -->
          <li>
            <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
          </li>
        </ul>
      </div>
      <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
      </svg>
    </button>



    <div class="container flex flex-wrap justify-between items-center mx-auto pt-0 pl-4">


      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
        </svg>
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

<!-- side bar drawer component -->
<div id="sidebar" class="mt-2 fixed top-16 left-0 z-40 h-screen p-4 pr-0 overflow-y-auto transition-transform bg-white w-80 dark:bg-gray-800 transform-none" tabindex="-1" aria-labelledby="sidebar-label" aria-modal="true" role="dialog">

  <div class="px-4">
    <div class="overflow-hidden flex bg-white overflow-visible relative max-w-sm mx-auto bg-white shadow-lg ring-1 ring-black/5 rounded-xl flex items-center gap-6 dark:bg-slate-800 dark:highlight-white/5">
      <!-- <img class="bg-blue-900 absolute -left-6 w-24 h-24 rounded-full shadow-lg" src="../src/Photo/<?php echo $username; ?>.png" > -->
      <?php

      $first_two_letters = substr($username, 0, 2);
      if ($first_two_letters != "GP" && $username != "lem") {
      ?> <div class=" absolute -left-6 w-24 h-24 rounded-full shadow-lg">

          <div class="rounded-full h-full w-full  mr-10" id="picture" style="background-color: #C5957F; background-size: cover; background-image: url('../src/Photo/default.png')"></div>
        </div>
      <?php
      } else if ($username == "lem") {
      ?>
        <div class=" absolute -left-6 w-24 h-24 rounded-full shadow-lg" style="padding-top: 10px;
   padding-right: 20px; background-color: #C5957F;">

          <div class="rounded-full h-full w-full  mr-10" id="picture" style="background-color: #C5957F;width: 125%; background-size: cover; background-image: url('../src/Photo/<?php echo $username; ?>.png')"></div>
        </div>
      <?php
      } else {
      ?>
        <div class=" absolute -left-6 w-24 h-24 rounded-full shadow-lg" style="padding-top: 10px;
    padding-right: 20px; background-color: #C5957F;">

          <div class="rounded-full h-full w-full  mr-10" id="picture" style="background-color: #C5957F;width: 125%; background-size: cover; background-image: url('../src/Photo/<?php echo $username; ?>.png')"></div>
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
        <a href="index.php" id="sidehome" class=" flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
          <!-- <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg> -->
          <i class="fa-solid fa-house"></i>
          <span class="ml-3">Home</span>
        </a>
      </li>

      <li>
        <a href="history.php" id="sidehistory" class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

          <i class="fa-solid fa-clock-rotate-left"></i> <span class="flex-1 ml-3 whitespace-nowrap">History</span>
        </a>
      </li>
      <li>
        <a href="pms.php" id="sidepms" class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

          <i class="fa-solid fa-broom"></i> <span class="flex-1 ml-3 whitespace-nowrap">PMS</span>
        </a>
      </li>
      <li>
        <a href="devices.php" id="sidedevice" class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">

          <i class="fa-solid fa-computer"></i> <span class="flex-1 ml-3 whitespace-nowrap">Devices</span>
        </a>
      </li>
    </ul>
  </div>
</div>

<div id="cut-off" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-md max-h-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="cut-off">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
      <div class="p-6 text-center">
        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
          Attention employees, today is the final cut-off for filing job orders (JOs). This is to complete all JOs by month-end. Filing will resume on the first day of next month. For immediate concerns, call ICT at local 212 and 129. Thank you for your cooperation. </h3>
        <button data-modal-toggle="cut-off" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
          I understand.
        </button>
      </div>
    </div>
  </div>
</div>
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