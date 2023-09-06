 <!-- Navigation Menu -->
 <div id="navbarContainer">
     <nav class="navbar">
         <!-- Logo -->
         <span role="link" tabindex="0" onclick="openPage('index.php')" class="logo">
             <img src="./assets/img/logo2.png" alt="logo">
         </span>

         <!-- Nav Menu Items -->
         <div class="group">
             <div class="navItem">
                 <!-- Search Bar -->
                 <span role="link" tabindex="0" onclick='openPage("search.php")' class="navItemLink">Search
                     <span class="material-symbols-outlined icon">
                         search
                     </span>
                 </span>
             </div>
         </div>

         <div class="group">
             <div class="navItem">
                 <span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Browse</span>
             </div>

             <div class="navItem">
                 <span role="link" tabindex="0" onclick="openPage('yourMusic.php')" class="navItemLink">Your Music</span>
             </div>

             <div class="navItem">
                 <span role="link" tabindex="0" onclick="openPage('settings.php')" class="navItemLink"><?php echo $userLoggedIn->getUsername($con) ?></span>
             </div>
         </div>
     </nav>

 </div>