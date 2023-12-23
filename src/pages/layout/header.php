<style>
  @media (min-width: 481px) {
    #custom-bg {
      background: transparent !important;
    }
  }

  @media (max-width: 480px) {
    #custom-bg {
      background: #ffffff !important;
    }
  }
</style>



<div class='h-[10vh] lg:mb-4 xl:nb-0'>
  <nav class="bg-white w-full">
  <div class="max-w-screen flex flex-wrap items-center justify-between mx-auto">
  <a href="?page=home" class="flex items-center">
      <img src="<?php echo baseUrlImageSrc('logo.png') ?>" class="h-8 mr-3" alt=" Logo" />
      <span class="hidden sm:block self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Harvesters’ Missions International School</span>
  </a>
  <div class="flex md:order-2 mb-2">
      <!-- <button onclick="routeSignup()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Signup</button> -->
      <button onclick="routeLogin()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
      <!-- <button onclick="routeLogin()" type="button" class="border-indigo text-gray-400 hover:text-white outline outline-offset-2 outline-1 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button> -->
      <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-cta" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
    <ul id='custom-bg' class="flex flex-col font-medium p-4 md:p-0  md:flex-row md:space-x-8 md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      <li>
        <a href="?page=home" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Home</a>

      </li>
      <!-- <li>
        <a href="?page=create" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Registration</a>
      </li> -->
      <li>
        <a href="?page=enrollment" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Track your record</a>
      </li>
      <li>
        <a href="?page=contact-us" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact Us</a>
      </li>
      
    </ul>
  </div>
  </div>
</nav>

</div>

<script>
  function routeLogin(){
    location.href = '?page=login'
  }

  function routeSignup(){
    location.href = '?page=create'
  }
</script>