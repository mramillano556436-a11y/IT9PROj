<x-admin-layout title="Users" subtitle="Manage account status with more obvious actions and cleaner row contrast.">
    @if(session('success'))
        <div class="ui-alert-success">{{ session('success') }}</div>
    @endif

    <section class="ui-card">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.26em] text-amber-700">Customer Accounts</p>
                <h3 class="mt-2 text-xl font-bold text-slate-900">User management</h3>
            </div>
            <input type="search" placeholder="Search users..." class="ui-input max-w-xs">
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="ui-table w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Orders</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white/80">
                    @forelse($users as $user)
                        <tr class="hover:bg-amber-50/60">
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-100 text-sm font-bold text-slate-900">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $user->name }}</p>
                                        <p class="mt-1 text-xs uppercase tracking-[0.16em] text-slate-500">{{ $user->role }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-slate-600">{{ $user->email }}</td>
                            <td class="font-semibold text-slate-900">{{ $user->orders->count() }}</td>
                            <td>
                                @if($user->status == 'active')
                                    <span class="ui-badge-success">Active</span>
                                @else
                                    <span class="ui-badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.users.update', $user->id) }}" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('PUT')
                                    @if($user->status == 'active')
                                        <button type="submit" class="ui-btn-danger px-4 py-2 text-sm">Deactivate</button>
                                    @else
                                        <button type="submit" class="ui-btn-secondary px-4 py-2 text-sm">Activate</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-admin-layout>
