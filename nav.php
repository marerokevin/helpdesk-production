<?php



$nname = $_SESSION['name'];
$llevel = $_SESSION['level'];
$username = $_SESSION['username'];


// echo $_SESSION['username'];

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

// $sql="select * from request where status2='for head approval' and approving_head='$nname'";
// $result = mysqli_query($con,$sql);
// $counthead = mysqli_num_rows($result);

// echo $rows_count_value; 

// $sql1="select * from request where status2='For Admin Approval' and approving_admin='$nname'";
// $result1 = mysqli_query($con,$sql1);
// $countadmin = mysqli_num_rows($result1);




?>


<nav class="bg-white px-2 sm:px-4 py-2.5 dark:bg-gray-900 fixed w-full z-20 top-0  left-0 border-b border-gray-200 dark:border-gray-600">

   <div class="flex items-center">

      <!-- slidebar button -->
      <a data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
         <!-- <i class="fa fa-list fa-xl"  style="color: gray;"></i> -->

         <img src="./resources/img/menu-bar.png" class=" w-8 h-8" alt="">
      </a>





      <div class="container flex flex-wrap justify-between items-center mx-auto pt-0 pl-4">

         <a class="flex items-center">
            <img src="resources/img/logo.jpg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Helpdesk

            </span>
         </a>






         <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
         </button>
         <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
               <li>
                  <a href="main.php" id="main_index" class=" block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
               </li>
               <li>
                  <a href="allrequest.php" id="allrequest" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Overall Active</a>
               </li>
               <li>
                  <a href="form.php" id="joform" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Request Form</a>
               </li>


               <!-- <li>
          <a href="#" id="side" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">System Menu</a>
        </li> -->


               <li>
                  <a href="userprofile.php" id="profile" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">User Page</a>
               </li>

            </ul>
         </div>

         <div>
            <a class="mr-6 ml-2 text-sm font-medium text-gray-500 dark:text-white hover:underline">Hi <?php echo $_SESSION['name'] ?> </a>
            <a href="logout.php" id="logintext" onmouseover="mouseOver()" class="login text-sm font-medium text-blue-600 dark:text-blue-500 pr-4 ">Logout</a>
            <!-- <a href="logout.php" id="loginicon" style="display: none" onmouseout="mouseOut()" class="iconlogin text-sm font-medium text-blue-600 dark:text-blue-500 pr-4 login">  -->
            <!-- <i class="fa-solid fa-right-to-bracket"></i> -->

            </a>


         </div>
      </div>


      <!-- darkmode button -->



   </div>







</nav>










<!-- side bar drawer component -->
<div id="drawer-navigation" class="fixed z-40 h-screen p-4 overflow-y-auto bg-sky-500 w-80 dark:bg-gray-800 transition-transform left-0 top-0 -translate-x-full" tabindex="-1" aria-hidden="true" aria-labelledby="drawer-navigation-label">
   <h5 id="drawer-navigation-label" class=" font-semibold text-gray-500 uppercase dark:text-white">System Menu</h5>
   <button type="button" data-drawer-dismiss="drawer-navigation" aria-controls="drawer-navigation" class="text-rose-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
         <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
      </svg>
      <span class="sr-only">Close menu</span>
   </button>
   <div class="py-4 overflow-y-auto">
      <ul class="space-y-2">
         <li>
            <a href="index.php" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <img aria-hidden="true" src="resources/img/dashboard.png" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
               <span class="flex-1 ml-3 whitespace-nowrap">Dashboard</span>
            </a>
         </li>

         <li>

            <a href="head_approval.php" class=" <?php if ($llevel == "user" || $llevel == "fem" || $llevel == "mis") { ?>hidden<?php } ?>  flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <img aria-hidden="true" src="resources/img/head.png" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
               <span class="flex-1 ml-3 whitespace-nowrap">Dept-Head Approval</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200"><?php echo $counthead ?></span>
            </a>
         </li>



         <li>
            <a href="admin_approval.php" class="  <?php if ($llevel == "head" || $llevel == "user" || $llevel == "mis" || $llevel == "fem") { ?>hidden<?php } ?> flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <img aria-hidden="true" src="resources/img/admin.png" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
               <span class="flex-1 ml-3 whitespace-nowrap">Final Approval</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200"><?php echo $countadmin ?></span>
            </a>
         </li>



         <li>
            <a href="#" class="<?php if ($llevel == "head" || $llevel == "user" || $llevel == "mis") { ?>hidden<?php } ?> flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <img aria-hidden="true" src="resources/img/fem.png" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
               <span class="flex-1 ml-3 whitespace-nowrap">FEM Pending</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">3</span>
            </a>
         </li>

         <li>
            <a href="#" class="<?php if ($llevel == "head" || $llevel == "user" || $llevel == "fem") { ?>hidden<?php } ?> flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <img aria-hidden="true" src="resources/img/mis.png" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
               <span class="flex-1 ml-3 whitespace-nowrap">ICT Pending </span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">3</span>
            </a>
         </li>


         <li>
            <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <img aria-hidden="true" src="resources/img/done.png" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
               <span class="flex-1 ml-3 whitespace-nowrap">Completed For Acceptance</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">3</span>
            </a>
         </li>

         <li>
            <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <img aria-hidden="true" src="resources/img/denied.png" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
               <span class="flex-1 ml-3 whitespace-nowrap">Disapproved Request</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">3</span>
            </a>
         </li>

         <li>
            <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <img aria-hidden="true" src="resources/img/rating.png" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
               <span class="flex-1 ml-3 whitespace-nowrap">Rating</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">3</span>
            </a>
         </li>

         <li>
            <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <img aria-hidden="true" src="resources/img/report.png" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
               <span class="flex-1 ml-3 whitespace-nowrap">Reports</span>
            </a>
         </li>
         <!-- <li>
            <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
               <span class="flex-1 ml-3 whitespace-nowrap">Users</span>
            </a>
         </li>
         -->


         <!-- <li>
            <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
               <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
               <span class="flex-1 ml-3 whitespace-nowrap">Sign In</span>
            </a>
         </li> -->

      </ul>
   </div>
</div>






<footer class="fixed bottom-0 left-0 z-40 p-4 w-full  border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 bg-white dark:bg-gray-900 " style="padding-top: 0.25px;">
   <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© <?php echo date('Y') ?> <a href="https://flowbite.com/" class="hover:underline">GPI FEM/ICT </a>: All Rights Reserved
   </span>

   <!-- <a href="mailto:j.nemedez@glory.com.ph" class="font-thin text-gray-400 text-left italic font-serif">Powered by: naith.<u class="text-blue-600">ph</u></a> -->

</footer>



<script>
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