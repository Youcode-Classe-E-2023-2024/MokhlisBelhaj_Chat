<?php require APPROOT . '\views\include\header.php'; ?>

<!-- component -->
<section class="flex flex-col md:flex-row h-screen items-center">

  <div class="bg-indigo-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
    <img src="https://source.unsplash.com/random" alt="" class="w-full h-full object-cover">
  </div>

  <div class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
        flex items-center justify-center">

    <div class="w-full text-center h-100">


      <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Log in to your account</h1>

      
      <form  action="<?php echo URLROOT; ?>authentication/login" method="post" class="mt-6">
        <div>
          <label class="block text-gray-700">Email Address</label>
          <input type="email" name="email" id="" placeholder="Enter Email Address" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none  <?php echo (!empty($data['email_err'])) ? 'bg-red-500' : ''; ?>" value="<?php echo $data['email']?>" autofocus autocomplete required>
                        <?php if (!empty($data["email_err"])) : ?>
                            <span class="text-red-500 text-sm"><?php echo $data["email_err"] ?></span>
                        <?php endif; ?>
          
        </div>

        <div class="mt-4 text">
          <label class="block text-gray-700">Password</label>
          <input type="password" name="password" id="" placeholder="Enter Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                focus:bg-white focus:outline-none <?php echo (!empty($data['password_err'])) ? 'bg-red-500' : ''; ?>" value="<?php echo $data['password']?>"required>
                        <?php if (!empty($data["password_err"])) : ?>
                            <span class="text-red-500 text-sm"><?php echo $data["password_err"] ?></span>
                        <?php endif; ?>
             
        </div>

       

        <button class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold rounded-lg
              px-4 py-3 mt-6">Log In</button>
      </form>
      <div class="mt-7">
                        <div class="flex justify-center items-center">
                            <label class="mr-2">
                            Not a member yet?</label>
                            <a href="<?php echo URLROOT ?>authentication/signup" class=" text-blue-500 transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                Sign up
                            </a>
                        </div>
                    </div>

    </div>
  </div>

</section>