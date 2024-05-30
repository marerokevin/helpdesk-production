<!-- <nav class="bg-white px-2 sm:px-4 py-2.5 dark:bg-gray-900 fixed w-full z-20 top-0  left-0 border-b border-gray-200 dark:border-gray-600"> -->
<nav class=" px-2 sm:px-4 py-2.5  fixed w-full z-20 top-0  left-0 ">


  <div class="flex items-center">

    <!-- slidebar button -->
    <!-- <a data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation"> 
   <i class="fa fa-list fa-xl"  style="color: gray;"></i>
   </a> -->




    <div class="container flex flex-wrap justify-between items-center mx-auto pt-0 pl-4">

      <!-- <a class="flex items-center" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation"> -->
      <img src="resources/img/helpdesk.png" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo">
      <span class="self-center text-xl font-semibold whitespace-nowrap text-white">HELPDESK

      </span>
      <!-- </a> -->






      <!-- <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
    </button> -->



      <!-- <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="main.php" id="main_index" class=" block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" >Home</a>
        </li>
        <li>
          <a href="allrequest.php" id="allrequest" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" >All Request</a>
        </li>
        <li>
          <a href="form.php" id="joform" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Request Form</a>
        </li>


        <li>
          <a href="userprofile.php" id="profile" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">User Page</a>
        </li>
        
      </ul>
    </div> -->


    </div>


    <!-- darkmode button -->

  </div>







</nav>
















<script>
  function mouseOver() {
    document.getElementById("loginicon").style.display = "inline";
    document.getElementById("logintext").style.display = "none";

  }

  function mouseOut() {
    document.getElementById("logintext").style.display = "inline";
    document.getElementById("loginicon").style.display = "none";

  }



  var homeoption = document.getElementById("homeoption");
  homeoption.classList.remove("text-gray-700");
  homeoption.classList.add("text-white");
  homeoption.classList.remove("dark:text-gray-400");
  homeoption.classList.add("dark:text-white");
</script>