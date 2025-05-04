@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="bg-white rounded-3xl p-8 shadow-xl">
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <!-- Users header section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold mb-2">USER MANAGEMENT</h1>
            <p class="text-lg text-gray-600">Manage system users</p>
        </div>
        <button onclick="openAddModal()" class="bg-[#18421F] text-white px-6 py-3 rounded-lg hover:bg-[#18421F]/90 flex items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Add User</span>
        </button>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($user->role) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button onclick="openEditModal({{ $user->id }})" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteUser({{ $user->id }})" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 w-[500px]">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-xl font-bold">Add New User</h3>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <input type="text" name="name" required class="w-full px-4 py-2 rounded-lg border border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 rounded-lg border border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role" required class="w-full px-4 py-2 rounded-lg border border-gray-300">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 rounded-lg border border-gray-300">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-[#18421F] text-white px-6 py-2 rounded-lg hover:bg-[#18421F]/90">
                    Add User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Include Edit Modal -->
@include('admin.partials.edit-modal', ['type' => 'User'])

<!-- Include Delete Modal -->
@include('admin.partials.delete-modal', ['type' => 'user'])

<script>
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

function openEditModal(userId) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    form.action = `/admin/users/${userId}`;
    
    // Fetch user data and populate form
    fetch(`/admin/users/${userId}/edit`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('editName').value = user.name;
            document.getElementById('editEmail').value = user.email;
            document.getElementById('editRole').value = user.role;
            modal.style.display = 'flex';
        });
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function deleteUser(userId) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/users/${userId}`;
    document.getElementById('deleteModal').style.display = 'flex';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
</script>
@endsection