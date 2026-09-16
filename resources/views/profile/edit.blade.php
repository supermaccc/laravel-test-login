<x-app-layout>
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">แก้ไขโปรไฟล์ส่วนตัว</h1>
            <p class="text-sm text-slate-500 mt-1">จัดการข้อมูลบัญชีผู้ใช้งานและรหัสผ่านของคุณ</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left: User Overview Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs text-center flex flex-col items-center">
                <div class="w-20 h-20 rounded-full bg-gradient-to-tr from-sky-500 to-indigo-600 text-white flex items-center justify-center font-bold text-2xl uppercase shadow-md mb-4">
                    {{ mb_substr($user->name, 0, 1) }}
                </div>
                <h3 class="font-bold text-slate-900 text-base">{{ $user->name }}</h3>
                <p class="text-xs text-slate-500 mt-0.5 font-mono">{{ $user->email }}</p>

                <div class="w-full mt-6 pt-6 border-t border-slate-100 text-left space-y-3 text-xs">
                    <div class="flex justify-between text-slate-600">
                        <span>รหัสผู้ใช้:</span>
                        <span class="font-mono font-semibold text-slate-900">#{{ $user->id }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>วันที่สร้างบัญชี:</span>
                        <span class="text-slate-900 font-medium">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>อัปเดตล่าสุด:</span>
                        <span class="text-slate-900 font-medium">{{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Right: Edit Form Card -->
            <div class="md:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-xs p-6 sm:p-8">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Section 1: ข้อมูลทั่วไป -->
                    <div>
                        <h2 class="text-base font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>ข้อมูลทั่วไป</span>
                        </h2>

                        <div class="space-y-4">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    ชื่อ - นามสกุล <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required 
                                       class="w-full px-4 py-2.5 bg-slate-50 border @error('name') border-rose-300 ring-1 ring-rose-300 @else border-slate-300 @enderror rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition text-sm">
                                @error('name')
                                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    อีเมล (Email) <span class="text-rose-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       required 
                                       class="w-full px-4 py-2.5 bg-slate-50 border @error('email') border-rose-300 ring-1 ring-rose-300 @else border-slate-300 @enderror rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition text-sm">
                                @error('email')
                                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: เปลี่ยนรหัสผ่าน -->
                    <div class="pt-4 border-t border-slate-100">
                        <h2 class="text-base font-bold text-slate-900 mb-1 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            <span>เปลี่ยนรหัสผ่าน (ไม่บังคับ)</span>
                        </h2>
                        <p class="text-xs text-slate-400 mb-4">เว้นว่างไว้หากไม่ต้องการเปลี่ยนรหัสผ่าน</p>

                        <div class="space-y-4">
                            <!-- Current Password -->
                            <div>
                                <label for="current_password" class="block text-xs font-medium text-slate-700 mb-1.5">
                                    รหัสผ่านปัจจุบัน (ต้องกรอกหากต้องการเปลี่ยนรหัสผ่าน)
                                </label>
                                <input type="password" 
                                       id="current_password" 
                                       name="current_password" 
                                       placeholder="••••••••"
                                       class="w-full px-4 py-2.5 bg-slate-50 border @error('current_password') border-rose-300 ring-1 ring-rose-300 @else border-slate-300 @enderror rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition text-sm">
                                @error('current_password')
                                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div>
                                <label for="password" class="block text-xs font-medium text-slate-700 mb-1.5">
                                    รหัสผ่านใหม่
                                </label>
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       placeholder="อย่างน้อย 6 ตัวอักษร"
                                       class="w-full px-4 py-2.5 bg-slate-50 border @error('password') border-rose-300 ring-1 ring-rose-300 @else border-slate-300 @enderror rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition text-sm">
                                @error('password')
                                    <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div>
                                <label for="password_confirmation" class="block text-xs font-medium text-slate-700 mb-1.5">
                                    ยืนยันรหัสผ่านใหม่อีกครั้ง
                                </label>
                                <input type="password" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="กรอกรหัสผ่านใหม่ซ้ำอีกครั้ง"
                                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
                        <button type="submit" 
                                class="px-6 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-semibold text-sm shadow-sm shadow-sky-600/20 transition focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>บันทึกข้อมูลส่วนตัว</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
