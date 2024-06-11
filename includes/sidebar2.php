<body class="bg-gray-100 font-sans leading-normal tracking-normal h-screen flex">
  <aside class="bg-white w-64 p-4 border-r overflow-y-auto">
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-center">Admin Dashboard</h1>
    </div>
    <ul>
      <li class="mb-4">
        <a href="#" class="flex items-center space-x-4 p-2 hover:bg-gray-200 rounded">
          <i class="iconoir-home text-2xl"></i>
          <span class="font-bold">Dashboard</span>
        </a>
      </li>
      <li class="mb-4">
        <div class="relative">
          <button class="flex items-center space-x-4 p-2 w-full hover:bg-gray-200 rounded focus:outline-none" onclick="toggleDropdown('users-dropdown')">
            <i class="iconoir-user text-2xl"></i>
            <span class="font-bold">Users</span>
            <i class="iconoir-arrow-right text-xl ml-auto transform transition-transform" id="users-dropdown-icon"></i>
          </button>
          <ul class="hidden mt-2 space-y-2" id="users-dropdown">
            <li>
              <a href="#" class="block p-2 pl-8 hover:bg-gray-200 rounded">All Users</a>
            </li>
            <li>
              <a href="#" class="block p-2 pl-8 hover:bg-gray-200 rounded">Add User</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="mb-4">
        <a href="#" class="flex items-center space-x-4 p-2 hover:bg-gray-200 rounded">
          <i class="iconoir-settings text-2xl"></i>
          <span class="font-bold">Settings</span>
        </a>
      </li>
      <li class="mb-4">
        <div class="relative">
          <button class="flex items-center space-x-4 p-2 w-full hover:bg-gray-200 rounded focus:outline-none" onclick="toggleDropdown('analytics-dropdown')">
            <i class="iconoir-stats-up text-2xl"></i>
            <span class="font-bold">Analytics</span>
            <i class="iconoir-arrow-right text-xl ml-auto transform transition-transform" id="analytics-dropdown-icon"></i>
          </button>
          <ul class="hidden mt-2 space-y-2" id="analytics-dropdown">
            <li>
              <a href="#" class="block p-2 pl-8 hover:bg-gray-200 rounded">Overview</a>
            </li>
            <li>
              <a href="#" class="block p-2 pl-8 hover:bg-gray-200 rounded">Reports</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="mb-4">
        <a href="#" class="flex items-center space-x-4 p-2 hover:bg-gray-200 rounded">
          <i class="iconoir-bell text-2xl"></i>
          <span class="font-bold">Notifications</span>
        </a>
      </li>
      <li class="mb-4">
        <a href="#" class="flex items-center space-x-4 p-2 hover:bg-gray-200 rounded">
          <i class="iconoir-logout text-2xl"></i>
          <span class="font-bold">Logout</span>
        </a>
      </li>
    </ul>
  </aside>
  <main class="flex-1 p-6">
    <h2 class="text-3xl font-bold mb-6">Welcome to the Admin Dashboard</h2>
    <p class="text-gray-700">Select an option from the sidebar to get started.</p>
  </main>

  <script>
    function toggleDropdown(dropdownId) {
      const dropdown = document.getElementById(dropdownId);
      const icon = document.getElementById(dropdownId + '-icon');
      dropdown.classList.toggle('hidden');
      icon.classList.toggle('rotate-90');
    }
  </script>
</body>