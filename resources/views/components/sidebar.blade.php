<aside class="top-0 z-10 w-64 min-h-screen bg-white border-r border-pink-100">

    {{-- Navigation --}}
    <nav class="p-5 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-3 rounded-2xl
                  text-pink-700 font-medium
                  hover:bg-pink-50 hover:text-pink-600
                  transition-all duration-200">

            Dashboard
        </a>

        <a href="{{ route('calendar') }}"
           class="flex items-center px-4 py-3 rounded-2xl
                  text-pink-700 font-medium
                  hover:bg-pink-50 hover:text-pink-600
                  transition-all duration-200">

            Calendar
        </a>

        <a href="/todos"
           class="flex items-center px-4 py-3 rounded-2xl
                  text-pink-700 font-medium
                  hover:bg-pink-50 hover:text-pink-600
                  transition-all duration-200">

            To Do
        </a>

        <a href="{{ route('tracker') }}"
           class="flex items-center px-4 py-3 rounded-2xl
                  text-pink-700 font-medium
                  hover:bg-pink-50 hover:text-pink-600
                  transition-all duration-200">

            Budget Tracker
        </a>

    </nav>

</aside>