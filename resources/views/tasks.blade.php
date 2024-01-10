<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-do List | All Tasks</title>
  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite('resources/css/app.css')
</head>
<body>
  @if (session()->has("success"))
    <div class="absolute top-0 left-0 w-[100%] bg-green-500 text-white p-2 text-center" x-data="{show: true}" x-init="setTimeout(() => show=false,3000)" x-show="show">
      {{session()->get("success")}}
    </div>
  @endif
  @if (session()->has("task_created"))
    <div class="absolute top-0 left-0 w-[100%] bg-green-500 text-white p-2 text-center" x-data="{show: true}" x-init="setTimeout(() => show=false,3000)" x-show="show">
      {{session()->get("task_created")}}
    </div>
  @endif
  @if (session()->has("task_deleted"))
    <div class="absolute top-0 left-0 w-[100%] bg-green-500 text-white p-2 text-center" x-data="{show: true}" x-init="setTimeout(() => show=false,3000)" x-show="show">
      {{session()->get("task_deleted")}}
    </div>
  @endif
  <nav class="flex justify-between px-20 py-6 shadow">
    <a href="/" class="text-black">Welcome, {{$username}}</a>
    <ul class="flex justify-end gap-6">
      <li><a href="{{route("logout")}}" class="text-black hover:text-blue-600"><i class="fa-solid fa-sign-out"></i> Logout</a></li>
      <li><a href="/profile" class="text-black hover:text-blue-600"><i class="fa-solid fa-user"></i> Profile</a></li>
    </ul>
  </nav>
  <div class="px-20 py-10">
    @if ($tasks->count() > 0)
      <div class="flex justify-between gap-10 rounded p-2">
        <h1 class="text-[30px] font-bold">All tasks</h1>
        <form action="{{route('search')}}" method="GET">
          <input type="text" name="search" id="search" placeholder="Search" class="px-2 py-1 border border-gray-400 outline-none mt-1">
          <button class="text-white bg-blue-600 p-1 px-3 uppercase rounded-sm">Search</button>
        </form>
      </div>
      <div>
        @foreach ($tasks as $task)
          <div class="border border-gray-400 mt-2 rounded p-2 flex justify-between items-center">
            <div>
              <h1 class="font-bold text-[20px]">{{$task->title}}</h1>
              <p>{{$task->description}}</p>
            </div>
            <a href="/{{$task->id}}" title="View task"><i class="fa fa-eye"></i></a>
          </div>
        @endforeach
        <a href="/add_task"><button class="w-[100%] mt-4 text-white bg-blue-600 px-2 py-1 rounded">Add More Tasks</button></a>
      </div>
    @else
      <div class="p-10 mt-[30px] flex justify-center flex-col">
        <img src="{{ asset('img/empty-task.png') }}" alt="No task" class="mx-auto w-[200px]">
        <p class="mx-auto text-lg">You don't have any tasks</p>
        <a href="/add_task" class="mx-auto"><button class="w-[100%] mt-5 text-white bg-blue-600 px-2 py-1 rounded-sm">Add a task</button></a>
      </div>
    @endif
  </div>
</body>
</html>