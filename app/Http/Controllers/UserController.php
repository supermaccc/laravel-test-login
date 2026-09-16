<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * แสดงรายชื่อผู้ใช้งานทั้งหมดในรูปแบบตาราง
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users', 'search'));
    }

    /**
     * แสดงฟอร์มสร้างผู้ใช้งานใหม่ (เฉพาะ Admin)
     */
    public function create(): View|RedirectResponse
    {
        if (! Auth::user()->isAdmin()) {
            return redirect()->route('users.index')->with('error', 'เฉพาะผู้ดูแลระบบ (Admin) เท่านั้นที่สามารถเพิ่มผู้ใช้งานใหม่ได้');
        }

        return view('users.create');
    }

    /**
     * บันทึกผู้ใช้งานใหม่ลงฐานข้อมูล (เฉพาะ Admin)
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::user()->isAdmin()) {
            return redirect()->route('users.index')->with('error', 'เฉพาะผู้ดูแลระบบ (Admin) เท่านั้นที่สามารถเพิ่มผู้ใช้งานใหม่ได้');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['nullable', 'string', 'in:admin,user'],
        ], [
            'name.required' => 'กรุณากรอกชื่อ-นามสกุล',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.unique' => 'อีเมลนี้มีอยู่ในระบบแล้ว',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'password.min' => 'รหัสผ่านต้องมีความยาวอย่างน้อย 6 ตัวอักษร',
            'password.confirmed' => 'การยืนยันรหัสผ่านไม่ตรงกัน',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'] ?? 'user',
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'เพิ่มผู้ใช้งานใหม่เรียบร้อยแล้ว');
    }

    /**
     * แสดงฟอร์มแก้ไขผู้ใช้งาน (Admin แก้ไขได้ทุกคน, User ทั่วไปแก้ไขได้เฉพาะตนเอง)
     */
    public function edit(User $user): View|RedirectResponse
    {
        if (! Auth::user()->isAdmin() && Auth::id() !== $user->id) {
            return redirect()->route('users.index')->with('error', 'คุณมีสิทธิ์แก้ไขได้เฉพาะข้อมูลบัญชีของตนเองเท่านั้น');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * บันทึกการแก้ไขข้อมูลผู้ใช้งาน
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        if (! Auth::user()->isAdmin() && Auth::id() !== $user->id) {
            return redirect()->route('users.index')->with('error', 'คุณมีสิทธิ์แก้ไขได้เฉพาะข้อมูลบัญชีของตนเองเท่านั้น');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'role' => ['nullable', 'string', 'in:admin,user'],
        ], [
            'name.required' => 'กรุณากรอกชื่อ-นามสกุล',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.unique' => 'อีเมลนี้มีอยู่ในระบบแล้ว',
            'password.min' => 'รหัสผ่านต้องมีความยาวอย่างน้อย 6 ตัวอักษร',
            'password.confirmed' => 'การยืนยันรหัสผ่านไม่ตรงกัน',
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        // เฉพาะ Admin เท่านั้นที่สามารถเปลี่ยน Role ได้
        if (Auth::user()->isAdmin() && isset($validated['role'])) {
            $userData['role'] = $validated['role'];
        }

        if (! empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }

        $user->update($userData);

        return redirect()->route('users.index')->with('success', "อัปเดตข้อมูลผู้ใช้งาน {$user->name} เรียบร้อยแล้ว");
    }

    /**
     * ลบผู้ใช้งานออกจากระบบ (เฉพาะ Admin และห้ามลบตัวเอง)
     */
    public function destroy(User $user): RedirectResponse
    {
        if (! Auth::user()->isAdmin()) {
            return redirect()->route('users.index')->with('error', 'เฉพาะผู้ดูแลระบบ (Admin) เท่านั้นที่สามารถลบผู้ใช้งานได้');
        }

        // ป้องกันไม่ให้ลบบัญชีตัวเองที่กำลังล็อกอินอยู่
        if (Auth::id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'ไม่สามารถลบบัญชีของตนเองที่กำลังล็อกอินอยู่ได้');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('users.index')->with('success', "ลบผู้ใช้งาน {$userName} เรียบร้อยแล้ว");
    }
}
