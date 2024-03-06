<template>
    <!-- 
        This is not a very beautiful UI but the logic is super intact. 😉
     -->
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
                <h3 class="text-center text-dark mt-2">Task Manager</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h5>Add Record</h5>
                <div class="card-body bg-dark text-white">

                    <!-- Form to insert task -->
                    <form @submit.prevent="save">

                        <div class="form-group mb-3">
                            <label>Task name</label>
                            <input type="text" v-model="task.title" class="form-control" placeholder="Task name">

                        </div>
                        <div class="form-group mb-3">
                            <label>Description</label>
                            <input type="text" v-model="task.description" class="form-control"
                                placeholder="Task Description">

                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" v-model="task.status"
                                    id="completedCheckbox">
                                <label class="form-check-label" for="completedCheckbox">Mark Complete</label>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">

                <!-- Table to Retrive tasks from the database -->
                <h5>Task List</h5>
                <table class="table  table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Task</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="task in result" v-bind:key="task.id">

                            <!-- Table head -->
                            <td>{{ task.id }}</td>
                            <td>{{ task.title }}</td>
                            <td>{{ task.description }}</td>
                            <td>
                                <span v-if="task.status">Completed</span>
                                <span v-else>Processing</span>
                            </td>

                            <!-- Action buttons to Edit and Delete Tasks -->
                            <td>
                                <button type="button" class="btn btn-sm btn-primary m-2"
                                    @click="edit(task)">Edit</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    @click="remove(task)">Delete</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <template v-if="!result.length">
                    <p class="text-center text-muted">Task list is empty, please add a task.</p>
                </template>
            </div>
        </div>
    </div>
</template>
<script>
/**
 * 
 * This scrips contains the codes for implimenting CRUD operations.
 *
 */

// Import Axios to making asynchronous requests via API.
import axios from 'axios';

export default {
    task: 'TaskList',
    data() {
        return {
            // Object to store API response.
            result: {},
            task: {
                id: '',
                task: '',
                description: '',
                status: false,
            }
        }
    },

    created() {
        // Load tasks when the component is created.
        this.TaskLoad();
    },

    methods: {
        TaskLoad() {
            // Retrive all the existing Tasks with the API.
            var page = "http://127.0.0.1:8000/api/tasks";
            axios.get(page)
                .then(
                    ({ data }) => {
                        console.log(data);
                        this.result = data;
                    }
                )

                // Alert an error message if something goes wrong and Tasks not fetched.
                .catch(error => {
                    console.error(error);
                    alert("Task list is empty!!!");
                });
        },

        save() {
            // Save new Task if Task id is empty.
            if (this.task.id == '') {
                this.saveData();
            }

            // Update the existing Task If Task id exists.
            else {
                this.updateData();
            }
        },

        saveData() {
            // Save the Task with the API.
            axios.post("http://127.0.0.1:8000/api/tasks", this.task)
                .then(
                    ({ data }) => {
                        this.id = ''
                        this.task.title = '';
                        this.task.description = '',
                            this.task.status = false;
                        this.TaskLoad();
                        alert("Task Saved Successfully!");
                    }
                )
                .catch(error => {
                    // Alert an error message if something goes wrong during Task creation.
                    console.error(error);
                    alert("Failed, Task Not Added!");
                });
        },

        edit(task) {
            // Set the current Task for editing
            this.task = task;
        },

        updateData() {
            // Update the selected Task with the API.
            var editrecords = 'http://127.0.0.1:8000/api/tasks/' + this.task.id;
            axios.put(editrecords, this.task)
                .then(
                    ({ data }) => {
                        this.id = ''
                        this.task.title = '';
                        this.task.description = '',
                            this.task.status = false;
                        this.TaskLoad();
                        alert("Task Updated Successfully!");
                    }
                )
                .catch(error => {
                    // Alert an error message if something goes wrong during Task update.
                    console.error(error);
                    alert("Task Update Failed!");
                });
        },

        remove(task) {
            // Delete a specific Task with the API.
            var url = `http://127.0.0.1:8000/api/tasks/${task.id}`;
            axios.delete(url);
            alert("Task Deleted Successfully!");
            this.TaskLoad();
        }
    }
}
</script>
