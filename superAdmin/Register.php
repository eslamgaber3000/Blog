<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Transparent Login Form HTML CSS</title>
      <link rel="stylesheet" href="../assets/css/style.css">
      <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> -->
   </head>
   <body>

   
 
      <div class="bg-img">
   
         <div class="content">
         <?php
   
   require_once("../inc/errors.php");
   // echo "hello word";
   ?>
            <header>Register Now</header>
           
            <form method="post" action="handleSignUp.php" >
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="name" required placeholder="enter your name">
               </div>
               <div class="field space">  
               <span class="fa-solid fa-envelope"></span>
                  <input type="text" name="email" class="pass-key" required placeholder="enter your email">
                  <!-- <span class="show">SHOW</span> -->
               </div>
               <div class="pass">
                  <!-- <a href="#">Forgot Password?</a> -->
               </div>
               <div class="field">
                  <span class="fa fa-lock"></span>
                  <input type="password" name="password" required placeholder="password">
                  <span class="show">SHOW</span>
               </div>
               <div class="field space">  
                  <span class="fa fa-mobile"></span>
                  <input type="text" name="phone" class="pass-key" required placeholder="phone">
                 
               </div>
               <div class="pass">
                  <!-- <a href="#">Forgot Password?</a> -->
               </div>
               <div class="field">
                  <input type="submit"  name="submit" value="Sign up">
               </div>
            </form>
         
            
            <div class="signup">
              you have account?
               <a href="login.php">Login Now</a>
            </div>
         </div>
      </div>
      <!-- <script>
         const pass_field = document.querySelector('.pass-key');
         const showBtn = document.querySelector('.show');
         showBtn.addEventListener('click', function(){
          if(pass_field.type === "password"){
            pass_field.type = "text";
            showBtn.textContent = "HIDE";
            showBtn.style.color = "#3498db";
          }else{
            pass_field.type = "password";
            showBtn.textContent = "SHOW";
            showBtn.style.color = "#222";
          }
         });
      </script> -->

      <!-- <script src="https://kit.fontawesome.com/c4a273ceda.js" crossorigin="anonymous"></script> -->
   </body>
</html>