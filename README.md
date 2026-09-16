# ระบบจัดการข้อมูลผู้ใช้งาน (User Management System)
> ข้อสอบภาคปฏิบัติสำหรับตำแหน่ง **PHP Laravel Developer**

Web Application สำหรับจัดการข้อมูลผู้ใช้งาน พัฒนาด้วย **PHP Laravel Framework**, ฐานข้อมูล **MySQL**, และระบบ **Laravel Authentication** (Session-based Auth) พร้อมการออกแบบหน้าตา UI ที่สะอาด ทันสมัย ใช้งานง่าย และรองรับ Responsive

---

## 🌟 ฟังก์ชันการทำงานของระบบ (Key Features)

1. **ระบบเข้าสู่ระบบและออกจากระบบ (Authentication - `/login`, `/logout`)**
   - ฟอร์มเข้าสู่ระบบด้วย Email และ Password
   - ระบบตรวจสอบความถูกต้อง (Validation) พร้อมแสดงข้อความแจ้งเตือนเมื่อรหัสผ่านไม่ถูกต้อง
   - ป้องกันการเข้าถึงหน้าที่มีสิทธิ์ด้วย **Auth Middleware** (หากยังไม่ล็อกอินจะไม่สามารถเข้าถึงหน้า Dashboard หรือ CRUD ได้)
   - จดจำการเข้าสู่ระบบ (Remember Me)
   - แสดงกล่องแนะนำบัญชีผู้ใช้ทดสอบ (One-click fill) สำหรับกรรมการตรวจข้อสอบ

2. **หน้าหลัก (Dashboard - `/dashboard`)**
   - เมนู Navigation Bar: ลิงก์ไปยังหน้าจัดการผู้ใช้งาน, หน้าโปรไฟล์ส่วนตัว, และปุ่มออกจากระบบ
   - การ์ดสรุปสถิติผู้ใช้งานทั้งหมด (Total Users)
   - การ์ดแสดงข้อมูลผู้ใช้ที่ล็อกอินอยู่
   - ตารางแสดง 5 ผู้ใช้งานล่าสุด

3. **หน้าจัดการผู้ใช้งาน (User Management CRUD - `/users`)**
   - **แสดงรายการ (Read):** ตารางรายชื่อผู้ใช้งานทั้งหมด แสดง ID, ชื่อ, Email, สถานะรหัสผ่าน (Hashed), วันที่สร้าง พร้อมระบบค้นหา (Search) และแบ่งหน้า (Pagination)
   - **เพิ่มผู้ใช้งาน (Create):** ฟอร์มกรอกชื่อ, Email, รหัสผ่าน, ยืนยันรหัสผ่าน พร้อม Validation เช็คอีเมลซ้ำและเข้ารหัสผ่านอย่างปลอดภัย
   - **แก้ไขผู้ใช้งาน (Update):** แก้ไขชื่อ, Email และสามารถเลือกเปลี่ยนรหัสผ่านใหม่หรือไม่ก็ได้ (Optional)
   - **ลบผู้ใช้งาน (Delete):** ลบผู้ใช้งานออกจากระบบ พร้อมกล่องยืนยันการลบ (Confirm Dialog) และระบบป้องกันไม่ให้ผู้ใช้ลบบัญชีของตนเองที่กำลังล็อกอินอยู่

4. **หน้าแก้ไขโปรไฟล์ส่วนตัว (Profile - `/profile/edit`)**
   - ผู้ใช้ที่ล็อกอินอยู่สามารถแก้ไขชื่อ, Email ของตนเองได้
   - รองรับการเปลี่ยนรหัสผ่านใหม่ (ต้องระบุรหัสผ่านปัจจุบันเพื่อความปลอดภัย)

---

## 💻 เทคโนโลยีที่ใช้ (Tech Stack)

- **Backend:** PHP 8.2+ / Laravel 12.x (MVC Architecture)
- **Database:** SQLite (Default - ไม่ต้องตั้งค่า Service Database เพิ่มเติม) หรือ MySQL
- **Authentication:** Laravel Auth (Session / Guard / Controller)
- **Frontend / Styling:** Blade Templates + Tailwind CSS (Responsive Design)
- **Testing:** Pest PHP (ครอบคลุม Feature Tests ทั้งหมด 22 tests)

---

## 🔑 ข้อมูลบัญชีผู้ใช้สำหรับทดสอบ (Default Test Account)

เมื่อรัน Seeder ระบบจะสร้างบัญชีผู้ดูแลระบบตั้งต้นและผู้ใช้งานตัวอย่างให้อัตโนมัติ:

| บัญชี | Email | Password |
|---|---|---|
| **Admin User** | `admin@example.com` | `password123` |

---

## 🚀 ขั้นตอนการติดตั้งและรันโปรเจกต์ (Installation & Setup)

### 1. ความต้องการของระบบ (Prerequisites)
- PHP >= 8.2 (พร้อม SQLite / PDO Extension)
- Composer
- Node.js & NPM

---

### 2. ดาวน์โหลดโปรเจกต์และติดตั้ง Dependencies

```bash
# 1. เข้าสู่โฟลเดอร์โปรเจกต์
cd laravel-test-login

# 2. ติดตั้ง PHP Dependencies
composer install

# 3. ติดตั้ง Node Dependencies & Build Assets
npm install
npm run build
```

---

### 3. ตั้งค่าสภาพแวดล้อม (Environment Setup)

คัดลอกไฟล์ `.env.example` ไปเป็น `.env`:

```bash
cp .env.example .env
```

สร้าง Application Key:

```bash
php artisan key:generate
```

---

### 4. รัน Database Migration และ Seeder

ฐานข้อมูลเริ่มต้นถูกกำหนดเป็น **SQLite** ในตัวเรียบร้อยแล้ว รันคำสั่งสร้างตารางและข้อมูลตัวอย่างได้ทันที:

```bash
php artisan migrate --seed
```

*(หากต้องการสลับไปใช้ **MySQL** สามารถเปลี่ยนค่า `DB_CONNECTION=mysql` ในไฟล์ `.env` ได้ตามต้องการ)*

---

### 6. เริ่มต้นรันเซิร์ฟเวอร์ (Start Server)

```bash
php artisan serve
```

เปิด Browser แล้วไปที่: **[http://localhost:8000](http://localhost:8000)** หรือ **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 🧪 การรันชุดทดสอบอัตโนมัติ (Automated Testing)

โปรเจกต์มี Feature Tests ครอบคลุมฟังก์ชันทั้งหมด (Auth, User CRUD, Profile):

```bash
php artisan test
```

ชุดการทดสอบประกอบด้วย:
- `tests/Feature/AuthTest.php` (ทดสอบ Login, Logout, Redirect, และ Auth Middleware)
- `tests/Feature/UserCrudTest.php` (ทดสอบแสดงตาราง, ค้นหา, สร้างผู้ใช้, แก้ไข, ลบ และป้องกันการลบตัวเอง)
- `tests/Feature/ProfileTest.php` (ทดสอบแก้ไขโปรไฟล์และเปลี่ยนรหัสผ่าน)

---

## 📁 โครงสร้างโปรเจกต์สำคัญ (Directory Structure)

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php       # ควบคุมระบบ Login / Logout
│   │   ├── DashboardController.php  # ควบคุมหน้า Dashboard
│   │   ├── UserController.php       # ควบคุม CRUD ผู้ใช้งาน (/users)
│   │   └── ProfileController.php    # ควบคุมการแก้ไขโปรไฟล์ (/profile/edit)
├── Models/
│   └── User.php                     # โมเดลข้อมูลผู้ใช้งาน
database/
├── migrations/                      # ไฟล์โครงสร้างตาราง users, sessions
└── seeders/
    └── DatabaseSeeder.php           # ใส่ข้อมูลเริ่มต้น Admin และผู้ใช้ตัวอย่าง
resources/
└── views/
    ├── layouts/
    │   ├── app.blade.php            # Layout หลักหลังล็อกอิน
    │   └── guest.blade.php          # Layout สำหรับหน้าล็อกอิน
    ├── auth/
    │   └── login.blade.php          # หน้าฟอร์มล็อกอิน
    ├── dashboard.blade.php          # หน้าแดชบอร์ด
    ├── users/
    │   ├── index.blade.php          # หน้ารายการผู้ใช้งาน (ตาราง + ค้นหา)
    │   ├── create.blade.php         # หน้าฟอร์มเพิ่มผู้ใช้งาน
    │   └── edit.blade.php           # หน้าฟอร์มแก้ไขผู้ใช้งาน
    └── profile/
        └── edit.blade.php           # หน้าฟอร์มแก้ไขข้อมูลส่วนตัว
routes/
└── web.php                          # กำหนดเส้นทาง URL ทั้งหมดของระบบ
tests/
└── Feature/                         # ชุด Feature Tests
```
