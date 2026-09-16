<x-app-layout>
    <!-- Welcome Header Banner -->
    <div class="mb-8 rounded-2xl bg-gradient-to-r from-sky-600 via-indigo-600 to-purple-600 p-6 md:p-8 text-white shadow-lg shadow-sky-900/10 relative overflow-hidden">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-xs font-medium text-sky-100 mb-3 border border-white/10">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                ออนไลน์ในระบบ
            </span>
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">ยินดีต้อนรับ, {{ $currentUser->name }} 👋</h1>
            <p class="mt-2 text-sky-100 text-sm sm:text-base leading-relaxed">
                เข้าสู่ระบบจัดการข้อมูลผู้ใช้งาน (User Management System) คุณสามารถดูภาพรวม จัดการผู้ใช้งาน และปรับปรุงข้อมูลส่วนตัวได้จากที่นี่
            </p>
            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('users.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-white text-slate-900 hover:bg-slate-100 rounded-xl font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    รายชื่อผู้ใช้งานทั้งหมด
                </a>
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('users.create') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-white/15 hover:bg-white/25 text-white border border-white/20 rounded-xl font-medium text-sm transition backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        เพิ่มผู้ใช้งานใหม่
                    </a>
                @else
                    <a href="{{ route('profile.edit') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-white/15 hover:bg-white/25 text-white border border-white/20 rounded-xl font-medium text-sm transition backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        แก้ไขข้อมูลส่วนตัวของคุณ
                    </a>
                @endif
            </div>
        </div>

        <!-- Decorative Pattern -->
        <div class="absolute -right-8 -bottom-8 opacity-10 pointer-events-none">
            <svg class="w-72 h-72" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
    </div>

    <!-- Stat & Info Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Total Users Stat -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs flex items-center gap-5 hover:border-slate-300 transition">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-600 shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">จำนวนผู้ใช้งานทั้งหมด</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-1">{{ number_format($userCount) }} <span class="text-sm font-normal text-slate-500">คน</span></h3>
                <a href="{{ route('users.index') }}" class="inline-flex items-center gap-1 text-xs text-sky-600 hover:text-sky-700 font-medium mt-2">
                    ดูรายชื่อทั้งหมด &rarr;
                </a>
            </div>
        </div>

        <!-- Current User Info -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs flex items-center gap-5 hover:border-slate-300 transition">
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">บัญชีของคุณ ({{ Auth::user()->isAdmin() ? 'Admin' : 'User' }})</p>
                <h3 class="text-base font-bold text-slate-900 mt-1 truncate">{{ $currentUser->name }}</h3>
                <p class="text-xs text-slate-500 truncate">{{ $currentUser->email }}</p>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1 text-xs text-indigo-600 hover:text-indigo-700 font-medium mt-2">
                    แก้ไขโปรไฟล์ &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Users Section -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">ผู้ใช้งานล่าสุด</h2>
                <p class="text-xs text-slate-500 mt-0.5">รายชื่อ 5 ผู้ใช้งานที่สร้างหรือเพิ่มเข้ามาล่าสุด</p>
            </div>
            <a href="{{ route('users.index') }}" 
               class="text-xs font-semibold text-sky-600 hover:text-sky-700 hover:underline">
                ดูทั้งหมด &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 font-semibold text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5">ผู้ใช้งาน</th>
                        <th class="px-6 py-3.5">อีเมล</th>
                        <th class="px-6 py-3.5">สิทธิ์ (Role)</th>
                        <th class="px-6 py-3.5">วันที่สร้าง</th>
                        <th class="px-6 py-3.5 text-right">การจัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentUsers as $user)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-slate-100 border border-slate-200 text-slate-700 flex items-center justify-center font-bold text-xs uppercase">
                                        {{ mb_substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-slate-900">{{ $user->name }}</div>
                                        @if($user->id === $currentUser->id)
                                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-sky-100 text-sky-800">คุณ</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 text-sm font-mono">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->isAdmin())
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">Admin</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 text-xs">
                                {{ $user->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                @if(Auth::user()->isAdmin() || Auth::id() === $user->id)
                                    <a href="{{ route('users.edit', $user) }}" 
                                       class="inline-flex items-center text-xs font-semibold text-sky-600 hover:text-sky-800">
                                        แก้ไข &rarr;
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400">ดูอย่างเดียว</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400 text-sm">
                                ยังไม่มีข้อมูลผู้ใช้งาน
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
