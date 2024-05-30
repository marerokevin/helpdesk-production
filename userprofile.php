<?php



//Set the session timeout for 1 hour

$timeout = 200;

//Set the maxlifetime of the session

ini_set("session.gc_maxlifetime", $timeout);

//Set the cookie lifetime of the session

ini_set("session.cookie_lifetime", $timeout);

// session_start();

$s_name = session_name();
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 200; URL=$url1");
//Check the session exists or not

if (isset($_COOKIE[$s_name])) {

    setcookie($s_name, $_COOKIE[$s_name], time() + $timeout, '/');
} else

    echo "Session is expired.<br/>";


// end of session timeout>";




session_start();

if (!isset($_SESSION['connected'])) {
    header("location: index.php");
}


// connection php and transfer of session
include("includes/connect.php");
$user_dept = $_SESSION['department'];
$user_level = $_SESSION['level'];


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk</title>


    <!-- font awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" /> -->
    <link rel="stylesheet" href="./fontawesome-free-6.2.0-web/css/all.min.css">



    <!-- tailwind play cdn -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- from flowbite cdn -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <!-- Script for jquery -->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>


    <link rel="shortcut icon" href="resources/img/helpdesk.png">
    <link rel="stylesheet" href="css/style.css" />


    <!-- darkmode -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>


</head>



<body onload=navFuntion() class="static  bg-white dark:bg-gray-900">

    <!-- nav -->
    <?php require_once 'nav.php'; ?>


    <!-- main -->

    <div class="  flex mt-24   left-10 right-5    flex flex-col  px-14 sm:px-14  pt-6 pb-14 z-50 ">

        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-3xl dark:text-white">JO : <span class="text-blue-600 dark:text-blue-500">User Profile</span></h1>


        <form>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                </div>
            </div>


            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <!-- <input type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  /> -->


                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"></label>
                    <select id="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" require>
                        <option selected disabled class="text-gray-700 ">Company</option>
                        <option value="GLORY">GLORY</option>
                        <option value="Maxim">MAXIM</option>
                        <option value="Nippi">NIPPI</option>
                        <option value="Powerlane">POWERLANE</option>

                    </select>


                </div>
                <div class="relative z-0 mb-6 w-full group">

                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"></label>
                    <select id="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" require>
                        <option selected disabled class="text-gray-700 ">Department</option>
                        <option value="ICT">Information and Communication Technology</option>
                        <option value="Accounting">Accounting</option>
                        <option value="Administration">Administration</option>
                        <option value="Parts Inspection">Parts Inspection</option>
                        <option value="PPD">PPD</option>
                        <option value="Production 1">Production 1</option>
                        <option value="Production 2">Production 2</option>
                        <option value="PPIC">PPIC</option>
                        <option value="Prodtech">Production Technology</option>
                        <option value="Purchasing">Purchasing</option>
                        <option value="QA">Quality Assurance</option>
                        <option value="QC">Quality Control</option>
                        <option value="DOK">* Direct Operation Kaizen</option>
                        <option value="Prodsupport">* Production Support</option>
                        <!-- <option value="SK">* System Kaizen</option> -->


                    </select>

                    <!-- <input type="text" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
        <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Department</label> -->
                </div>
            </div>





            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input type="password" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                </div>
            </div>









            <!-- <div class="relative z-0 mb-6 w-full group">
      <input type="password" name="repeat_password" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
      <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
  </div> -->

            <!-- <div class="grid md:grid-cols-2 md:gap-6">
    <div class="relative z-0 mb-6 w-full group">
        <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="floating_phone" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone number (123-456-7890)</label>
    </div>
    <div class="relative z-0 mb-6 w-full group">
        <input type="text" name="floating_company" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Company (Ex. Google)</label>
    </div>
  </div> -->
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>



        </form>

    </div>




    <!-- end of main -->
    <!-- 
datetime picker js -->

    <script src="node_modules/flowbite/dist/datepicker.js"></script>


    <!-- <script src="../path/to/flowbite/dist/flowbite.js"></script> -->
    <script src="node_modules/flowbite/dist/flowbite.js"></script>





    <!-- script for option code -->

    <script>
        $('#section').change(function() {
            var $options = $('#type')
                .val('')
                .find('option')
                .show();
            if (this.value != '0')
                $options
                .not('[data-val="' + this.value + '"], [data-val=""]')
                .hide();
            $('#type option:eq(0)').prop('selected', true)
            // console.log("asd");

        })

        //blocking of error on refresh page
        var $options = $('#type')
            .val('')
            .find('option')
            .show();
        if (this.value != '0')
            $options
            .not('[data-val="' + this.value + '"], [data-val=""]')
            .hide();
        $('#type option:eq(0)').prop('selected', true)


        //   end of script for category
    </script>
    <!-- darkmode script -->
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
    </script>




    <!-- script for valid request date schedule -->
    <!-- <input type="date" id="birthdaytime" onchange="testDate()" name="birthdaytime"> -->
    <script>
        var setdate2;

        function testDate() {
            var chosendate = document.getElementById("datestart").value;


            //  console.log(chosendate)
            const x = new Date();
            const y = new Date(chosendate);

            if (x < y) {
                console.log("Valid");
                var monthNumber = new Date().getMonth() + 1;
                const asf = new Date(chosendate);
                asf.setDate(asf.getDate() + 3);
                var setdate = asf.getFullYear() + "-" + monthNumber + "-" + asf.getDate();
                document.getElementById("dateend").value = setdate;

                setdate2 = asf.getFullYear() + "-" + monthNumber + "-" + asf.getDate();
                console.log(setdate)


                // console.log(x)
            } else {
                alert("Sorry your request date is not accepted!")

                const z = new Date();
                var monthNumber = new Date().getMonth() + 1
                z.setDate(z.getDate() + 1);
                console.log(z);
                var setdate = z.getFullYear() + "-" + monthNumber + "-" + z.getDate();
                document.getElementById("datestart").value = setdate;
                console.log(setdate)

                const asf2 = new Date(setdate);
                asf2.setDate(asf2.getDate() + 3);
                setdate2 = asf2.getFullYear() + "-" + monthNumber + "-" + asf2.getDate();
                document.getElementById("dateend").value = setdate2;

            }
        }

        function endDate() {
            console.log(setdate2);


            var chosendate3 = document.getElementById("dateend").value;
            console.log(chosendate3);

            const x = new Date(setdate2);
            const y = new Date(chosendate3);

            if (x < y) {


                // console.log(x)
            } else {
                alert("Sorry your request date is not accepted!")
                document.getElementById("dateend").value = setdate2;

            }
        }



        // active page highlight

        var activepage = document.getElementById("profile");
        activepage.classList.remove("text-gray-700");
        activepage.classList.add("text-blue-700");
        activepage.classList.remove("dark:text-gray-400");
        activepage.classList.add("dark:text-white");
    </script>








</body>

</html>