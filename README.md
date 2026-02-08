# 📘 Dokumentasi API – Laravel

Template dokumentasi API Laravel yang siap dipakai untuk **README GitHub** atau dokumentasi internal tim.

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

`POST /auth/login`

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
  "status": true,
  "message": "Login success",
  "data": {
    "token": "Bearer xxxxx",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "user@mail.com"
    }
  }
}
```

---

### Logout

`POST /auth/logout`

**Headers**

```
Authorization: Bearer {token}
```

**Response 200**

```json
{
  "status": true,
  "message": "Logout success"
}
```

---

## 👤 Users

### Get All Users

`GET /users`

**Headers**

```
Authorization: Bearer {token}
```

**Query Params (Optional)**

| Parameter | Type   | Description          |
| --------- | ------ | -------------------- |
| page      | int    | Pagination page      |
| search    | string | Search by name/email |

**Response 200**

```json
{
  "status": true,
  "message": "List users",
  "data": [
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@mail.com"
    }
  ]
}
```


---

### Create User

`POST /users`

**Request Body**

```json
{
  "name": "John Doe",
  "email": "john@mail.com",
  "password": "password"
}
```

**Response 201**

```json
{
  "status": true,
  "message": "User created"
}
```

---

### Update User

`PUT /users/{id}`

**Request Body**

```json
{
  "name": "John Updated"
}
```

---

### Delete User

`DELETE /users/{id}`

**Response 200**

```json
{
  "status": true,
  "message": "User deleted"
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
* Gunakan pagination untuk data besar
* Gunakan API Resource untuk response konsisten

---
