# 📘 Dokumentasi API – Laravel

Dokumentasi API Laravel untuk Manajemen Karyawan (CRUD).

---

## 📌 Informasi Umum

* **Nama Proyek**: Laravel REST API
* **Versi API**: v1
* **Base URL**:

```
https://domain.com/api/v1
```

* **Format Response**: JSON
* **Authentication**: Bearer Token (Laravel Sanctum / JWT)

---

## 🛠️ Tech Stack

* PHP ^8.x
* Laravel ^10
* MySQL / MariaDB
* Laravel Sanctum (Auth)

---

## 🔐 Authentication

### Login

`POST /login`

**Request Body**

```json
{
  "email": "user@mail.com",
  "password": "password"
}
```

**Response 200**

```json
{
    "status": "success",
    "message": "Login berhasil",
    "data": {
        "token": "4|JUwPINoh4AVS3siUs09EUeAzle8pqOlrekxlm9tO9a5a77d6",
        "admin": {
            "id": "019c387d-e25d-72c8-8998-24977b4257f9",
            "name": "Joko",
            "username": "admin",
            "phone": "081234567890",
            "email": "admin@example.com"
        }
    }
}
```

---

### Logout

`POST /logout`

**Headers**

```
Authorization: Bearer {token}
```

**Response 200**

```json
{
    "status": "success",
    "message": "Logout successfully"
}
```

---


### Get All Divisions

`GET /divisions`

**Headers**

```
Authorization: Bearer {token}
```

**Query Params (Optional)**

| Parameter | Type   | Description          |
| --------- | ------ | -------------------- |
| page      | int    | Pagination page      |
| search    | string | Search by name |

**Response 200**

```json
{
    "status": "success",
    "message": "List Divisions",
    "data": {
        "data": [
            {
                "id": "019c387d-e27a-7063-b62e-f2c00ae6f248",
                "name": "UI/UX Designer"
            }
        ],
        "pagination": {
            "total": 1,
            "per_page": 10,
            "current_page": 1,
            "last_page": 1,
            "from": 1,
            "to": 1
        }
    }
}
```


---

### Create Employee

`POST /employees`

**Request Body**

```json
{
    "image": "file foto pegawai",
    "name": "nama pegawai",
    "phone": "no telepon pegawai",
    "division": "uuid divisi",
    "position": "jabatan pegawai",
}
```

**Response 201**

```json
{
    "status": "success",
    "message": "Employee created successfully"
}
```

---



### Get Employee

`GET  /employees`

**Request Body**

```json
{
    "name": "pencarian nama",
    "division_id": "filter berdasarkan divisi",
}

```
**Response 201**

```json
{
    "status": "success",
    "message": "Employee Found",
    "data": {
        "employees": [
            {
                "id": "019c3891-531a-70da-8e7c-89d9db6a0db7",
                "image": "http://127.0.0.1:8000/storage/employees/MwE8LjaXHPLjUUpdicGonIjFRBMmCoZZfWeT4qfb.png",
                "name": "Emmanuel",
                "phone": "0832131333",
                "division_id": "019c387d-e27a-7063-b62e-f2c00ae6f248",
                "position": "Manager Informatika",
                "created_at": "2026-02-07T14:46:14.000000Z",
                "updated_at": "2026-02-08T10:40:09.000000Z",
                "division": {
                    "id": "019c387d-e27a-7063-b62e-f2c00ae6f248",
                    "name": "UI/UX Designer",
                    "created_at": "2026-02-07T14:25:00.000000Z",
                    "updated_at": "2026-02-07T14:25:00.000000Z"
                }
            },
            {
                "id": "019c3b1b-9bd4-7078-a9e9-29be0c4fb321",
                "image": "http://127.0.0.1:8000/storage/employees/q5fG0vyuQOoURk7xKcDnYaLK66H2jyAFc0XPv0dG.png",
                "name": "Emmanuelaaa",
                "phone": "434243443",
                "division_id": "019c387d-e27a-7063-b62e-f2c00ae6f248",
                "position": "Manager",
                "created_at": "2026-02-08T02:36:31.000000Z",
                "updated_at": "2026-02-08T02:36:31.000000Z",
                "division": {
                    "id": "019c387d-e27a-7063-b62e-f2c00ae6f248",
                    "name": "UI/UX Designer",
                    "created_at": "2026-02-07T14:25:00.000000Z",
                    "updated_at": "2026-02-07T14:25:00.000000Z"
                }
            }
        ],
        "pagination": {
            "total": 2,
            "per_page": 10,
            "current_page": 1,
            "last_page": 1,
            "from": 1,
            "to": 2
        }
    }
}
```

### Update Employee

`PUT /employees`

**Request Body**

```json
{
    "image": "file foto pegawai",
    "name": "nama pegawai",
    "phone": "no telepon pegawai",
    "division": "uuid divisi",
    "position": "jabatan pegawai",
}
```

**Response 201**

```json
{
    "status": "success",
    "message": "Employee updated successfully"
}
```


---

### Delete Employees

`DELETE /employees/{uuid pegawai}`

**Response 200**

```json
{
    "status": "success",
    "message": "Employee deleted successfully"
}
```

---

## 📦 Response Format Standar

### Success

```json
{
  "status": true,
  "message": "Success message",
  "data": {}
}
```

### Error

```json
{
  "status": false,
  "message": "Error message",
  "errors": {}
}
```

---

## ❗ HTTP Status Code

| Code | Description           |
| ---- | --------------------- |
| 200  | OK                    |
| 201  | Created               |
| 400  | Bad Request           |
| 401  | Unauthorized          |
| 403  | Forbidden             |
| 404  | Not Found             |
| 422  | Validation Error      |
| 500  | Internal Server Error |

---
## 📑 Catatan
* Semua endpoint (kecuali login) membutuhkan token
---
