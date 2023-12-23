<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>No internet connection</title>

  <style>



  .no-internet img {
    width: 100%;
    max-width: 100%;
    height: 100vh;
    object-fit: contain;
    position: relative;
  }

.no-internet {
    background: url(<?php echo baseUrlScriptSrc('/images/bg-login-stock.svg') ?>) no-repeat;
    background-position: center bottom;
    background-size: cover;
    object-fit: contain;
    position: relative;
}

.no-internet::before {
    content: '';
    display: inline-block;
    vertical-align: middle;
    height: 100%;
}

.overlay {
    position: absolute;
    top: 0%;
    left: 0;
    right: 0;
    bottom: 80%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99999;
}

.overlay p {
    color: #D05582;
    font-weight: 700;
    text-align: center;
    text-transform: uppercase;
    margin: 0;
    padding: 0;
    font-size: 4rem; /* Default font size for larger screens */

    /* Adjust font size for smaller screens */
}

@media screen and (max-width: 1280px) {
    .overlay p {
        font-size: 2rem;
    }
}

  </style>
</head>
 <script>
      (function(){
           if(navigator.onLine){
         fetch('https://jsonplaceholder.typicode.com/users')
          .then(response => {
            if (response.ok) {
              console.log('Method 1 - Fetch API: Internet connection is available.');
              location.href = 'index.php?page=home'
            } else {
              console.log('Method 1 - Fetch API: No internet connection.');
            
            }
          })
          .catch(error => {
            console.log('Method 1 - Fetch API: No internet connection.');
           
          });
      }
      else{
       
      }

      })();

    </script>



<body>
  <div class='no-internet'>
    <img src="<?php echo baseUrlScriptSrc('/images/offline.svg') ?>" alt="No internet" />

    <div class='overlay'><p>No internet connection</p></div>
  </div>
</body>
</html>