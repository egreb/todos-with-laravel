<x-app-layout>
    <div class="container max-w-md mx-auto">
        <header class="flex justify-center">
            <h1 class="text-4xl text-gray-800">Todos!</h1>

        </header>
        <form class="flex items-center flex-col py-4" method="POST" action="/todo/create">
            @csrf
            <div class="flex justify-center flex-1 w-full shadow-lg">
                <input name="title" type=" text" placeholder="What todo?" class="p-2 text-gray-600 w-full rounded-r-none rounded-l-md font-bold font-sans focus:border-blue-400" />
                <button class="bg-blue-500 rounded-l-none rounded-r-md p-2 text-lg text-white font-bold hover:bg-blue-400">Submit</button>
            </div>
            @error('title')
            <p class="text-red-500 alert alert-danger">{{ $message }}</p>
            @enderror
        </form>

        <ul class="flex flex-col gap-y-2 pt-5">
            @foreach($todos as $todo)
            <li class="flex flex-col text-gray-800 border border-gray-200 rounded-md bg-white p-4 shadow-md hover:cursor-pointer">
                <header class="flex items-center text-2xl">
                    <span @class(['line-through'=> $todo->done])>{{ $todo->title }}</span>
                </header>
                <footer class="w-full flex justify-end gap-x-5">
                    <form action="/todo/{{ $todo->id }}/complete" method="post">
                        @csrf
                        @method('patch')
                        <button type="submit" class="text-green-400 hover:text-green-500 hover:font-bold disabled:pointer-events-none disabled:text-gray-400" {{ $todo->done ? 'disabled' : '' }}>done</button>
                    </form>
                    <form method="POST" action="/todo/delete/{{ $todo->id }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-red-400 hover:font-bold hover:text-red-500">delete</button>
                    </form>
                </footer>
            </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
