<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-do List | Login</title>
  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite('resources/css/app.css')
</head>
<body>
  @if (session()->has("message"))
    <div class="absolute top-0 left-0 w-[100%] bg-green-500 text-white p-2 text-center" x-data="{show: true}" x-init="setTimeout(() => show=false,3000)" x-show="show">
      {{session()->get("message")}}
    </div>
  @endif
  <nav class="flex justify-between px-20 py-6 shadow">
    <a href="/" class="text-black">TO-DO LIST</a>
    <ul class="flex justify-end gap-6">
        <li><a href="/login" class="text-blue-600 hover:text-blue-600"><i class="fa-solid fa-sign-in"></i> Login</a></li>
        <li><a href="/register" class="text-black hover:text-blue-600"><i class="fa-solid fa-user-plus"></i> Register</a></li>
    </ul>
  </nav>
  <form action="" method="POST" class="shadow p-10 w-[40%] mx-auto mt-[30px]">
    @csrf
    <legend class="text-center font-bold text-2xl uppercase">Login</legend>
    @if (session()->has('error'))
      <div class="text-red-500 bg-red-200 px-2 py-1 mt-1 text-center">
        {{session()->get("error")}}
      </div>
    @endif
    <div class="flex justify-start flex-col gap-6">
      <div class="flex justify-start flex-col mt-5">
        <label for="email" class="text-xl">Email</label>
        <input type="email" name="email" id="email" placeholder="Please enter your email" class="border-solid border-2 px-2 py-1 rounded-sm mt-2">
      </div>
      <div class="flex justify-start flex-col">
        <label for="password" class="text-xl">Password</label>
        <input type="password" name="password" id="password" placeholder="Please enter your password" class="border-solid border-2 px-2 py-1 rounded-sm mt-2">
      </div>
    </div>
    <button class="w-[100%] mt-5 text-white bg-blue-600 px-2 py-1 rounded-sm">Login</button>
  </form>
</body>
</html>