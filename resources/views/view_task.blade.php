<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-do List | {{$task->title}}</title>
  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite('resources/css/app.css')
</head>
<body>
  @if (session()->has("task_updated"))
    <div class="absolute top-0 left-0 w-[100%] bg-green-500 text-white p-2 text-center" x-data="{show: true}" x-init="setTimeout(() => show=false,3000)" x-show="show">
      {{session()->get("task_updated")}}
    </div>
  @endif
  <nav class="flex justify-between px-20 py-6 shadow">
    <a href="/" class="text-black">Welcome, {{$username}}</a>
    <ul class="flex justify-end gap-6">
      <li><a href="{{route("logout")}}" class="text-black hover:text-blue-600"><i class="fa-solid fa-sign-out"></i> Logout</a></li>
      <li><a href="/profile" class="text-black hover:text-blue-600"><i class="fa-solid fa-user"></i> Profile</a></li>
    </ul>
  </nav>
  <div class="shadow p-10 w-[40%] mx-auto mt-[30px]">
    <h1 class="text-[30px] font-bold text-center">{{$task->title}}</h1>
    <div class="flex items-center justify-between">
        <p class="text-[18px] font-bold text-center"><span>Priority Level: </span>{{$task->priority_level}}</p>
        <p class="text-[18px] font-bold text-center"><span>Due date: </span>{{$task->due_date}}</p>
    </div>
    <p class="mt-3">{{$task->description}}</p>
    <a href="/edit_task/{{$task->id}}"><button class="w-[100%] mt-5 text-white bg-blue-600 px-2 py-1 rounded-sm">Update Task</button></a>
    <form action="{{ route('delete_task', ['taskId' => $task->id]) }}" method="post">
      @csrf
      @method('delete')
      <button class="w-[100%] mt-5 text-white bg-blue-600 px-2 py-1 rounded-sm">Delete Task</button>
    </form>
  </div>
</body>
</html>