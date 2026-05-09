# 🎓 Rule Sistem SIAKAD — Penjadwalan — Laravel 12

> **Framework:** Laravel 12 | **UI:** Bootstrap 5.3 CDN + Font Awesome 6 CDN  
> **Role:** Admin, Dosen & Mahasiswa | **Fokus:** Penjadwalan Kuliah

---

## Stack Teknologi

| Layer     | Teknologi                             |
|-----------|---------------------------------------|
| Backend   | Laravel 12 (PHP 8.3+)                 |
| Database  | MySQL 8                               |
| Frontend  | Blade + Bootstrap 5.3 CDN + FA 6 CDN |

```html
<!-- Bootstrap 5.3 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome 6 CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
```

---

## Struktur Database & Relasi

> Semua tabel wajib berelasi — tidak ada tabel yang berdiri sendiri.

```
roles ──── users
             │
      ┌──────┴──────┐
   (dosen)      (mahasiswa)
      │              │
   schedules ─── enrollments
      │
   ┌──┴────────┐
courses      rooms
```

### Tabel

#### `roles`
```sql
id         BIGINT PK
name       VARCHAR(50)   -- 'admin' | 'dosen' | 'mahasiswa'
created_at TIMESTAMP
updated_at TIMESTAMP
```

#### `users`
```sql
id           BIGINT PK
role_id      BIGINT FK → roles.id
name         VARCHAR(100)
email        VARCHAR(150) UNIQUE
password     VARCHAR(255)
identifier   VARCHAR(50) UNIQUE   -- NIP untuk dosen, NIM untuk mahasiswa
is_active    BOOLEAN DEFAULT TRUE
created_at   TIMESTAMP
updated_at   TIMESTAMP
```

#### `courses`
```sql
id          BIGINT PK
name        VARCHAR(150)
code        VARCHAR(20) UNIQUE   -- kode mata kuliah, cth: CS101
credits     TINYINT              -- jumlah SKS
created_at  TIMESTAMP
updated_at  TIMESTAMP
```

#### `rooms`
```sql
id          BIGINT PK
name        VARCHAR(100)         -- cth: Ruang A1, Lab Komputer
capacity    INT
created_at  TIMESTAMP
updated_at  TIMESTAMP
```

#### `schedules`
```sql
id          BIGINT PK
course_id   BIGINT FK → courses.id
lecturer_id BIGINT FK → users.id    -- harus role dosen
room_id     BIGINT FK → rooms.id
day         ENUM('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')
start_time  TIME
end_time    TIME
semester    VARCHAR(20)              -- cth: Ganjil 2024/2025
created_at  TIMESTAMP
updated_at  TIMESTAMP
```

#### `enrollments`
```sql
id          BIGINT PK
schedule_id BIGINT FK → schedules.id
student_id  BIGINT FK → users.id    -- harus role mahasiswa
created_at  TIMESTAMP
updated_at  TIMESTAMP

UNIQUE(schedule_id, student_id)
```

---

## Role & Hak Akses

### 👑 Admin

| Modul            | Akses                         |
|------------------|-------------------------------|
| Manajemen User   | CRUD (admin, dosen, mahasiswa)|
| Mata Kuliah      | CRUD                          |
| Ruangan          | CRUD                          |
| Jadwal           | CRUD                          |
| Enrollments      | Lihat semua                   |

### 👨‍🏫 Dosen

| Modul            | Akses                              |
|------------------|------------------------------------|
| Manajemen User   | ❌                                 |
| Mata Kuliah      | Lihat saja                         |
| Ruangan          | Lihat saja                         |
| Jadwal           | Lihat jadwal milik sendiri         |
| Enrollments      | Lihat daftar mahasiswa di kelasnya |

### 🎓 Mahasiswa

| Modul            | Akses                              |
|------------------|------------------------------------|
| Manajemen User   | ❌                                 |
| Mata Kuliah      | Lihat saja                         |
| Ruangan          | ❌                                 |
| Jadwal           | Lihat semua jadwal tersedia        |
| Enrollments      | Daftar & batalkan jadwal sendiri   |

---

## Modul & Fitur

### 1. Manajemen User *(Admin only)*
- CRUD user dengan assign role
- Field: nama, email, NIM/NIP, role, status aktif
- Tidak bisa hapus user yang punya jadwal / enrollment

### 2. Mata Kuliah *(Admin: CRUD | Dosen & Mahasiswa: lihat)*
- CRUD mata kuliah
- Field: nama, kode, jumlah SKS
- Tidak bisa hapus jika masih ada jadwal

### 3. Ruangan *(Admin: CRUD | Dosen: lihat)*
- CRUD ruangan
- Field: nama ruangan, kapasitas
- Tidak bisa hapus jika masih ada jadwal

### 4. Jadwal *(Admin: CRUD | Dosen: lihat milik sendiri | Mahasiswa: lihat semua)*
- Admin buat jadwal: pilih mata kuliah, dosen, ruangan, hari, jam, semester
- Validasi bentrok: dosen & ruangan tidak boleh bentrok di hari + jam yang sama
- Dosen lihat jadwal mengajar miliknya
- Mahasiswa lihat semua jadwal yang tersedia di semester aktif

### 5. Enrollment *(Mahasiswa: daftar & batal | Admin: lihat | Dosen: lihat kelasnya)*
- Mahasiswa pilih jadwal lalu klik daftar
- Validasi: tidak boleh daftar jadwal yang bentrok (hari + jam)
- Tidak boleh daftar jadwal yang sama dua kali
- Mahasiswa bisa batalkan enrollment selama semester aktif
- Dosen lihat siapa saja mahasiswa yang terdaftar di kelasnya
- Admin lihat semua enrollment

---

## Struktur Direktori

```
app/Http/Controllers/
├── Auth/LoginController.php
├── Admin/
│   ├── DashboardController.php
│   ├── UserController.php
│   ├── CourseController.php
│   ├── RoomController.php
│   └── ScheduleController.php
├── Dosen/
│   ├── DashboardController.php
│   └── ScheduleController.php     ← jadwal milik sendiri + daftar mahasiswa
└── Mahasiswa/
    ├── DashboardController.php
    ├── ScheduleController.php      ← lihat semua jadwal
    └── EnrollmentController.php    ← daftar & batalkan

app/Http/Middleware/
└── CheckRole.php

app/Models/
├── Role.php
├── User.php
├── Course.php
├── Room.php
├── Schedule.php
└── Enrollment.php

resources/views/
├── layouts/
│   ├── app.blade.php
│   └── auth.blade.php
├── auth/login.blade.php
├── admin/
│   ├── dashboard/index.blade.php
│   ├── users/
│   ├── courses/
│   ├── rooms/
│   └── schedules/
├── dosen/
│   ├── dashboard/index.blade.php
│   └── schedules/
└── mahasiswa/
    ├── dashboard/index.blade.php
    ├── schedules/
    └── enrollments/
```

---

## Konvensi Kode

### Routes

```php
// routes/web.php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', Admin\UserController::class);
    Route::resource('courses', Admin\CourseController::class);
    Route::resource('rooms', Admin\RoomController::class);
    Route::resource('schedules', Admin\ScheduleController::class);
});

Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('dashboard', [Dosen\DashboardController::class, 'index'])->name('dashboard');
    Route::get('schedules', [Dosen\ScheduleController::class, 'index'])->name('schedules');
    Route::get('schedules/{schedule}/students', [Dosen\ScheduleController::class, 'students'])->name('schedules.students');
});

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('dashboard', [Mahasiswa\DashboardController::class, 'index'])->name('dashboard');
    Route::get('schedules', [Mahasiswa\ScheduleController::class, 'index'])->name('schedules');
    Route::post('enrollments/{schedule}', [Mahasiswa\EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('enrollments/{schedule}', [Mahasiswa\EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
    Route::get('enrollments', [Mahasiswa\EnrollmentController::class, 'index'])->name('enrollments.index');
});
```

### Middleware CheckRole

```php
// app/Http/Middleware/CheckRole.php
public function handle(Request $request, Closure $next, string $role): Response
{
    if (auth()->user()?->role->name !== $role) {
        abort(403);
    }
    return $next($request);
}
```

### Registrasi Middleware (Laravel 12)

```php
// bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias(['role' => CheckRole::class]);
})
```

### Relasi Model

```php
// Role
public function users(): HasMany { return $this->hasMany(User::class); }

// User
public function role(): BelongsTo { return $this->belongsTo(Role::class); }
public function schedules(): HasMany { return $this->hasMany(Schedule::class, 'lecturer_id'); }   // dosen
public function enrollments(): HasMany { return $this->hasMany(Enrollment::class, 'student_id'); } // mahasiswa

// Course
public function schedules(): HasMany { return $this->hasMany(Schedule::class); }

// Room
public function schedules(): HasMany { return $this->hasMany(Schedule::class); }

// Schedule
public function course(): BelongsTo { return $this->belongsTo(Course::class); }
public function lecturer(): BelongsTo { return $this->belongsTo(User::class, 'lecturer_id'); }
public function room(): BelongsTo { return $this->belongsTo(Room::class); }
public function enrollments(): HasMany { return $this->hasMany(Enrollment::class); }
public function students(): HasManyThrough { return $this->hasManyThrough(User::class, Enrollment::class, 'schedule_id', 'id', 'id', 'student_id'); }

// Enrollment
public function schedule(): BelongsTo { return $this->belongsTo(Schedule::class); }
public function student(): BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
```

### Validasi Bentrok Jadwal (di ScheduleController)

```php
// Cek bentrok dosen
$dosenBentrok = Schedule::where('lecturer_id', $request->lecturer_id)
    ->where('day', $request->day)
    ->where('semester', $request->semester)
    ->where(function ($q) use ($request) {
        $q->whereBetween('start_time', [$request->start_time, $request->end_time])
          ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
    })->exists();

// Cek bentrok ruangan
$ruanganBentrok = Schedule::where('room_id', $request->room_id)
    ->where('day', $request->day)
    ->where('semester', $request->semester)
    ->where(function ($q) use ($request) {
        $q->whereBetween('start_time', [$request->start_time, $request->end_time])
          ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
    })->exists();

if ($dosenBentrok) return back()->with('error', 'Dosen sudah memiliki jadwal di waktu tersebut.');
if ($ruanganBentrok) return back()->with('error', 'Ruangan sudah digunakan di waktu tersebut.');
```

---

## Aturan UI

- Sidebar berbeda per role: Admin = biru gelap, Dosen = ungu gelap, Mahasiswa = oranye gelap
- Setiap form wajib ada `@csrf`
- Tampilkan `session('success')` dan `session('error')` setelah aksi
- Tombol hapus wajib konfirmasi JS
- Tabel pakai `table-hover table-striped` Bootstrap
- Redirect setelah login berdasarkan role ke dashboard masing-masing

### Icon per Menu

| Menu              | Icon FA                  |
|-------------------|--------------------------|
| Dashboard         | `fa-tachometer-alt`      |
| User              | `fa-users`               |
| Mata Kuliah       | `fa-book`                |
| Ruangan           | `fa-door-open`           |
| Jadwal            | `fa-calendar-alt`        |
| Enrollment / KRS  | `fa-clipboard-list`      |
| Logout            | `fa-sign-out-alt`        |

---

## Aturan Bisnis

1. Dosen tidak bisa ditetapkan mengajar dua jadwal di hari & jam yang sama
2. Ruangan tidak bisa dipakai dua jadwal di hari & jam yang sama
3. Mahasiswa tidak bisa mendaftar jadwal yang bentrok dengan jadwal yang sudah diambil
4. Mahasiswa tidak bisa mendaftar jadwal yang sama dua kali
5. Mata kuliah & ruangan tidak bisa dihapus jika masih ada jadwal
6. User tidak bisa dihapus jika punya jadwal atau enrollment
7. Redirect login otomatis ke dashboard sesuai role

---

## Seeder Default

```
Admin     → admin@siakad.com     / password  (NIP: 000001)
Dosen     → dosen@siakad.com     / password  (NIP: 198501012010011001)
Mahasiswa → mahasiswa@siakad.com / password  (NIM: 2024010001)
```

---

## Instalasi Cepat

```bash
composer create-project laravel/laravel siakad
cd siakad
# set .env → DB_DATABASE=siakad
php artisan migrate --seed
php artisan serve
```
