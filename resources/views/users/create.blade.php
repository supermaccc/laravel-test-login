<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <!-- Back Link & Header -->
        <div class="mb-6">
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900 transition mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>กลับไปยังหน้ารายการผู้ใช้งาน</span>
            </a>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">เพิ่มผู้ใช้งานใหม่</h1>
            <p class="text-sm text-slate-500 mt-1">กรอกข้อมูลเพื่อสร้างบัญชีผู้ใช้งานใหม่ลงในระบบฐานข้อมูล</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6 sm:p-8">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                        ชื่อ - นามสกุล <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           placeholder="เช่น สมชาย ใจดี"
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
                           value="{{ old('email') }}" 
                           required 
                           placeholder="somchai@example.com"
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('email') border-rose-300 ring-1 ring-rose-300 @else border-slate-300 @enderror rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition text-sm">
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Field -->
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700 mb-1.5">
                        สิทธิ์การใช้งาน (Role) <span class="text-rose-500">*</span>
                    </label>
                    <select id="role" 
                            name="role" 
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition text-sm">
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User (ผู้ใช้งานทั่วไป - แก้ไขได้เฉพาะข้อมูลตนเอง)</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (ผู้ดูแลระบบ - จัดการผู้ใช้ได้ทุกคน)</option>
                    </select>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">
                        รหัสผ่าน (Password) <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           placeholder="อย่างน้อย 6 ตัวอักษร"
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('password') border-rose-300 ring-1 ring-rose-300 @else border-slate-300 @enderror rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition text-sm">
                    <p class="mt-1 text-xs text-slate-400">ต้องมีความยาวอย่างน้อย 6 ตัวอักษร</p>
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">
                        ยืนยันรหัสผ่านอีกครั้ง <span class="text-rose-500">*</span>
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           required 
                           placeholder="กรอกรหัสผ่านเดิมซ้ำอีกครั้ง"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:bg-white transition text-sm">
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('users.index') }}" 
                       class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-50 font-medium text-sm transition">
                        ยกเลิก
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-semibold text-sm shadow-sm shadow-sky-600/20 transition focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>บันทึกข้อมูล</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
