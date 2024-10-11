# Mini Task Management API

## Table of Contents

- [Introduction](#introduction)
- [Database Schema](#database-schema)
- [API Endpoints](#api-endpoints)
    - [1. Login](#1-login)
    - [2. List Tasks](#2-list-tasks)
    - [3. Update Task](#3-update-task)
    - [4. Store Task](#4-store-task)
    - [5. Delete Task](#5-delete-task)
- [Design Patterns](#design-patterns)
- [Docker](#docker)
- [Authentication](#authentication)
- [Postman Collection](#postman-collection)

## Introduction

This project provides a comprehensive suite of APIs for managing tasks, creation, and filtering. The API includes features for listing task, retrieving task details, and searching for specific tasks.

## Database Schema

### Entities and Attributes

- `tasks`: id, title, description, due_date, user_id
- `users`: id, name, email, password


## API Endpoints

## Path Table

| Method | Path       | Description        |
|--------|------------|--------------------|
| POST   | /api/login | Authenticate User  |
| GET    | /api/tasks | List All Tasks     |
| PUT    | /api/tasks | Update Single Task |
| POST   | /api/tasks | Store New Task     |
| DELETE | /api/tasks | Delete Task        |


### 1. Login

Endpoint: `/api/login`

Description: Authenticate user and generate token

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"

**Request Body:**
```json
{
    "email": "admin@admin.com",
    "password": "password"
}

```
### 2. List Tasks

Endpoint: `/api/tasks?search=status:pending;due_date:2024-12-11&searchJoin=or`

Description: Lists all the tasks

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- Authorization: "Bearer {{token}}"

**Sample Response:**
```json
{
    "data": [
        {
            "id": 1,
            "title": "Error ipsum.",
            "description": "Animi eos expedita quasi omnis hic iusto.",
            "status": "pending",
            "due_date": "2024-10-12",
            "user": {
                "id": 1,
                "name": "Admin User",
                "email": "admin@admin.com"
            }
        },
        {
            "id": 4,
            "title": "Omnis inventore.",
            "description": "Eos tempore suscipit nemo ullam perferendis voluptatibus laborum.",
            "status": "pending",
            "due_date": "2024-10-12",
            "user": {
                "id": 1,
                "name": "Admin User",
                "email": "admin@admin.com"
            }
        },
        {
            "id": 5,
            "title": "Voluptas aperiam aut.",
            "description": "Est itaque et iure et minus quia aut.",
            "status": "pending",
            "due_date": "2024-10-14",
            "user": {
                "id": 1,
                "name": "Admin User",
                "email": "admin@admin.com"
            }
        }
    ]
}
```

### 3. Update Task

Endpoint: `/api/tasks?id=2&title=Updated Title&status=in_progress`

Description: updates single task


**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- Authorization: "Bearer {{token}}"

**Sample Response:**
```json
{
    "status": "success",
    "code": 200,
    "message": "Success",
    "data": {
        "id": 2,
        "title": "Updated Title",
        "description": "Et sint rem repellendus sequi sapiente sint natus debitis eligendi quos sint quam rem.",
        "status": "in_progress",
        "due_date": "2024-10-12",
        "user": {
            "id": 1,
            "name": "Admin User",
            "email": "admin@admin.com"
        }
    }
}
```

### 4. Store Task

Endpoint: `/api/tasks`

Description: Create a Task


**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- Authorization: "Bearer {{token}}"

**Request Body:**
```json
{
    "title": "My First Title",
    "description": "My First description",
    "status": "pending",
    "due_date": "2024-12-11"
}
```

**Sample Response:**
```json
{
    "status": "success",
    "code": 201,
    "message": "Success",
    "data": {
        "id": 7,
        "title": "My First Title",
        "description": "My First description",
        "status": "pending",
        "due_date": "2024-12-11",
        "user": {
            "id": 1,
            "name": "Admin User",
            "email": "admin@admin.com"
        }
    }
}
```

### 5. Delete Task

Endpoint: `/api/tasks?id=3`

Description: Purchase tickets

**Headers:**
- Content-Type: "application/json"
- Accept: "application/json"
- Authorization: "Bearer {{token}}"

**Sample Response:**
```json
{
    "status": "success",
    "code": 200,
    "message": "Task deleted",
    "data": []
}
```

## Bonus 

- Implemented pagination to handle a large number of tasks
- Implemented searching tasks by title via a query parameter.
 
## Design Patterns

- Action Design Pattern for handling single responsibility methods
- Service Oriented Architecture (SOA) for handling multiple responsibility methods
- Repository Pattern for handling multiple responsibility methods and data persistence


## Authentication

Authentication With Sanctum

## Postman Collection

To facilitate testing and integration, provide a Postman collection that includes sample requests for each API endpoint, along with expected responses. This will help users understand how to interact with your API.

[Link to Postman Collection](https://www.postman.com/navigation-engineer-30611453/my-public-workspace/collection/zrun9ut/skyloov-task) - Update this link once you create the collection.


- BaseUrl: your app link
- bearer_token : the token from login
- In Every Api Body have example about request


# Requirements
- PHP 8.3
- Laravel 11
- MySQL

## Getting Started


## Clone
Clone this repo to your local machine using https://github.com/Maahmoudd/skyloov-task-manager
and run
```
git clone https://github.com/Maahmoudd/skyloov-task-manager.git
cd skyloov-task-manager
cp .env.example .env
composer install
composer dumpautoload
```

# Laravel sail
run  ./vendor/bin/sail up -d to setup environment by docker
```
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
```

## Run Migrations
```bash
 ./vendor/bin/sail artisan migrate:fresh --seed
 ````
## Run Queue
```bash
 ./vendor/bin/sail artisan queue:work
 ````
## Run Scheduler
```bash
 ./vendor/bin/sail artisan schedule:run
 ````
## Run Test
```bash
 ./vendor/bin/sail artisan test
 ````
