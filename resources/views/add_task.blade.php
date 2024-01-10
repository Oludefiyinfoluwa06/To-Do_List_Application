<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-do List | Add a Task</title>
  <script src="//unpkg.com/alpinejs" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite('resources/css/app.css')
</head>
<body>
  <nav class="flex justify-between px-20 py-6 shadow">
    <a href="/" class="text-black">Welcome, {{$username}}</a>
    <ul class="flex justify-end gap-6">
        <li><a href="{{route("logout")}}" class="text-black hover:text-blue-600"><i class="fa-solid fa-sign-out"></i> Logout</a></li>
        <li><a href="/profile" class="text-black hover:text-blue-600"><i class="fa-solid fa-user"></i> Profile</a></li>
    </ul>
  </nav>
  <form action="{{ route("create_task") }}" method="POST" class="shadow p-10 w-[40%] mx-auto mt-[30px]">
    @csrf
    <legend class="text-center font-bold text-2xl uppercase">Add a Task</legend>
    <div class="flex justify-start flex-col gap-6">
        <div class="flex justify-start flex-col mt-5">
            <label for="title" class="text-xl">Title</label>
            <input type="text" name="title" id="title" placeholder="Please enter the task's title" class="border-solid border-2 px-2 py-1 rounded-sm mt-2">
            @error("title")
                <div class="text-red-500 bg-red-200 px-2 py-1 mt-1">{{$message}}</div>
            @enderror
        </div>
        <div class="flex justify-start flex-col">
            <label for="description" class="text-xl">Description</label>
            <input type="text" name="description" id="description" placeholder="Please enter a description" class="border-solid border-2 px-2 py-1 rounded-sm mt-2">
            @error("description")
                <div class="text-red-500 bg-red-200 px-2 py-1 mt-1">{{$message}}</div>
            @enderror
        </div>
        <div class="flex justify-start flex-col">
            <label for="due_date" class="text-xl">Due date</label>
            <input type="date" name="due_date" id="due_date" placeholder="Please enter a due date" class="border-solid border-2 px-2 py-1 rounded-sm mt-2">
            @error("due_date")
                <div class="text-red-500 bg-red-200 px-2 py-1 mt-1">{{$message}}</div>
            @enderror
        </div>
        <div class="flex justify-start flex-col">
            <label for="priority_level" class="text-xl">Priority Level</label>
            <select name="priority_level" id="priority_level" class="border-solid border-2 px-2 py-1 rounded-sm mt-2">
                <option value="">Select a priority level</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
            @error("priority_level")
                <div class="text-red-500 bg-red-200 px-2 py-1 mt-1">{{$message}}</div>
            @enderror
        </div>
    </div>
    <button class="w-[100%] mt-5 text-white bg-blue-600 px-2 py-1 rounded-sm">Add task</button>
  </form>
</body>
</html>