# Task Manager Web Application: Setup and Usage Guide

## This guide walks you through setting up and using the Task Manager web application.

**Prerequisites:**

- Git installed on your system
- Node.js (version 14 or later) and npm installed on your system
- A code editor of your choice


## 1. Clone the project:

- Open your terminal or command prompt.
- Navigate to the directory where you want to clone the project.
- Use the following command to clone the project from the Git repository:

```bash
git clone https://github.com/gilbertozioma/Gilbert-Fullstack-Task-Laravel-and-Vue.git
```

##

## 2. Update composer

Run the following command to update the composer and download the vendor dependencies folder

```bash
composer update
```

##

## 3. Run migration:

- You need to set your database credentials in the ".env" file but don't worry about that because I have already included the configured ".env" file for this task.
- Navigate to the project's root directory in your terminal.
- Run the following command to execute the database migration:

```bash
php artisan migrate
```
The command will prompt you to confirm creating the database named "gilbert-fullstack_task" (the default name). Select "yes" to proceed.

##

## 4. Install dependencies:

**i. Navigate to the "vue-frontend" directory within the project:**

```Bash
cd vue-frontend
```

**ii. Install the project's dependencies using npm:**

```bash
npm install
```

##

## 5. Start the development server:

Run the following command to start the development server:

```Bash
npm run dev
```
This will start a local development server, typically accessible at http://localhost:5174/ or http://localhost:8080/ in your web browser. The exact URL might vary depending on your system configuration.

##

## 6. Using the Task Manager:

Once the server is running, you can access the Task Manager interface in your browser. Here's how to use various features:

## Features:

**i. Adding Tasks:**

- In the "Add Record" section, enter the task title and description in the respective input fields.
- (Optional) Check the "Mark Complete" checkbox if the task is already finished.
- Click the "Save" button to add the new task to the list.

**ii. Viewing Tasks:**

- The "Task List" section displays a table containing all tasks retrieved from the backend API. The default API URL is http://127.0.0.1:8000/api/tasks

**iii. Editing Tasks:**

- Click the "Edit" button next to the task you want to modify.
- Edit the title, and description, or mark the task as completed using the checkbox.
- Click the "Save" button again to update the changes.

**iv. Deleting Tasks:**

- Click the "Delete" button next to the task you want to remove from the task list.

##

By following these steps, you should be able to successfully set up and use the Task Manager web application. 🙂
