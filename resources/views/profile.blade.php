<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-do List | User Profile</title>
  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite('resources/css/app.css')
</head>
<body>
  @if (session()->has("profile_edit_success"))
    <div class="absolute top-0 left-0 w-[100%] bg-green-500 text-white p-2 text-center" x-data="{show: true}" x-init="setTimeout(() => show=false,3000)" x-show="show">
      {{session()->get("profile_edit_success")}}
    </div>
  @endif
  <nav class="flex justify-between px-20 py-6 shadow">
    <a href="/" class="text-black">Welcome, {{$username}}</a>
    <ul class="flex justify-end gap-6">
        <li><a href="{{route("logout")}}" class="text-black hover:text-blue-600"><i class="fa-solid fa-sign-out"></i> Logout</a></li>
        <li><a href="/profile" class="text-blue-600 hover:text-blue-600"><i class="fa-solid fa-user"></i> Profile</a></li>
    </ul>
  </nav>
  <div class="shadow p-10 w-[40%] mx-auto mt-[30px]">
    <h2 class="text-center font-bold text-2xl uppercase">User Profile</h2>
    <div class="flex justify-center w-[100%] flex-col mt-2">
      <ul class="flex justify-between border-b-2 border-solid py-5">
        <li class="font-bold text-lg">Name</li>
        <li>{{$username}}</li>
      </ul>
      <ul class="flex justify-between border-b-2 border-solid py-5">
        <li class="font-bold text-lg">Email</li>
        <li>{{$email}}</li>
      </ul>
    </div>
    <a href="/edit"><button class="w-[100%] mt-5 text-white bg-blue-600 px-2 py-1 rounded-sm">Edit Profile</button></a>
  </div>
</body>
</html>