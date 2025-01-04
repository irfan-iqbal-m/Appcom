<template>
  <AuthenticatedLayout>
    <section class="section dashboard">
      <div class="col-12">
    <div id="content-wrapper">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <h1>Task Listing</h1>
          <p><small>Manage your task listings. You can add, edit and delete your tasks.</small></p>
         <button type="button" class="btn btn-primary m-1" @click="showCatergoryModel= true"><i class="fa fa-plus"></i> Add Category</button>
          <button type="button" class="btn btn-primary m-1" @click="showAddTaskModel= true"><i class="fa fa-plus"></i> Add Task</button>

          <!-- Profile Picture -->
          <img :src="`${avatar}`" style="float:right;width:100px;height: 100px">
        </div>
      </div>

      <!-- Tasks Listing Table -->
      <div class="card my-3">
        <div class="card-header">
          <i class="fas fa-table"></i> Manage Your Tasks
        </div>

        <div class="card-body">
          <!-- Search and Filter -->
          <div class="row">
            <div class="col-md-4 form-group">
              <input v-model="searchQuery" class="form-control" type="search" placeholder="Search" aria-label="Search">
            </div>
            <div class="col-md-2 form-group">
              <button type="button" class="btn btn-primary" @click="searchTasks"><i class="fa fa-search"></i> Search</button>
            </div>

            <div class="col-md-4 form-group">
              <select v-model="selectedCategory" class="form-control" aria-label="Default select example">
                <option value="" selected>Choose category</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.title }}</option>
              </select>
            </div>
            <div class="col-md-2 form-group">
              <button type="button" class="btn btn-primary" @click="filterTasks"><i class="fa fa-filter"></i> Filter</button>
            </div>
          </div>

          <br>

          <a type="button" style="float:right;" :href="route('export-excel')" class="btn btn-success" @click="exportToExcel"><i class="fa fa-list"></i> Export to Excel</a>

          <button type="button" style="float:left;" class="btn btn-danger" @click="confirmDelete"><i class="fa fa-trash"></i> Delete</button>
          <br><br>

          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><input type="checkbox" v-model="selectAll" @change="toggleSelectAll"></th>
                  <th width="90px">S No.</th>
                  <th>Task Name</th>
                  <th>Description</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Category Name</th>
                  <th>Task Image</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(task, index) in filteredTasks" :key="task.id">
                  <td><input type="checkbox" v-model="selectedTasks" :value="task.id"></td>
                  <td>{{ index + 1 }}</td>
                  <td>{{ task.title }}</td>
                  <td>{{ task.description }}</td>
                  <td>{{ task.start_date }}</td>
                  <td>{{ task.end_date }}</td>
                  <td>{{ task.category.title }}</td>
                  <td><img :src="`/storage/${task.image}`" style="width:70px;height: 70px;"></td>
                  <td><button type="button" class="btn btn-success" @click="openEditModal(task)"><i class="fa fa-edit"></i> Edit Task</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © 2018</span>
        </div>
      </div>
    </footer>
    <!-- Modals -->
      <AddCategoryModal 
       v-if="showCatergoryModel" @close="showCatergoryModel = false"
    @add-category="handleAddCategory"
    />
      <AddTaskModal
     v-if="showAddTaskModel" :categories="categories" @close="showAddTaskModel = false"
      @add-task="handleAddTask"
    />
      <ConformDelete
      v-if="showConfirmModal"
      :to_delete_id="taskToDelete"
      @close-confirm-modal="showConfirmModal = false"
      @delete-task="handleDelete"
    />
     <EditTaskModal
      v-if="showEditModal" @close="showEditModal = false"
      :taskData="EditTask"
      :categories="categories"
      @update-task="handleTaskUpdate"
    />



  </div>
  </div>
  </div>

    </section>
  </AuthenticatedLayout>
</template>



<script>

import AddCategoryModal from './AddCategoryModal.vue';
import AddTaskModal from './AddTaskModal.vue';
import EditTaskModal from './EditTaskModal.vue';
import ConformDelete from './ConformDelete.vue';
import { Inertia } from '@inertiajs/inertia';
// import ConfirmationModal from './ConfirmationModal.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css'

export default {
 
props: {
    categories: {
      type: Array,
      required: true,
    },
    tasks: {
      type: Array, 
      required: true,
    },
    avatar: {
      type: String,
      required: true,
    },
  },




  data() {
    return {

      // tasks: [],
      // filteredTasks: [], 
      // categories: [], 
    filteredTasks: [],
      selectedCategory: "",
      searchQuery: "",

      EditTask: [],
      currentTask: null,
      showEditModal: false,
      selectAll: false,
      showCatergoryModel: false,
      showAddTaskModel: false,
      selectedTasks: [],
      showConfirmModal: false,
      taskToDelete: null, // Task to delete
    };
  },


  
  mounted() {
    
    this.filteredTasks = this.tasks; 
  },


  
  methods: {
    searchTasks() {
      if (this.searchQuery) {
        this.selectedCategory = '';
       this.filteredTasks = this.tasks.filter(
          (task) =>
            task.title.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      } else {
        this.filteredTasks = this.tasks;
      }
    },
    filterTasks() {
      
      // Filter tasks based on the selected category
      if (this.selectedCategory) {
         this.searchQuery = '';
        this.filteredTasks = this.tasks.filter(
          (task) => task.category.id === parseInt(this.selectedCategory)
        );
      } else {
        // Show all tasks if no category is selected
        this.filteredTasks = this.tasks;
      }
    },
    exportToExcel() {
      // Implement export logic
    },

  confirmDelete() {
      if (this.selectedTasks.length > 0) {
        this.taskToDelete = this.selectedTasks[0]; // Select the first task for deletion
        this.showConfirmModal = true;
       
      } else {
        alert("Please select a task to delete.");
      }
    },
    closeConfirmModal() {
      this.showConfirmModal = false;
    },
    handleDelete(to_delete_id) {
      Inertia.delete(`/tasks/${to_delete_id}`, {
        onSuccess: () => {
          // Update the tasks list and close the modal
          this.tasks = this.tasks.filter((task) => task.id !== to_delete_id);
          this.selectedTasks = this.selectedTasks.filter(
            (id) => id !== to_delete_id
          );
           this.showConfirmModal = false;
          this.closeConfirmModal();
        },
        onError: (errors) => {
          console.error("Failed to delete task:", errors);
           this.showConfirmModal = false;
          this.closeConfirmModal();
        },
      });
    },
   
    editTask(task) {
      this.currentTask = task;
      this.showEditModal = true;
    },
    toggleSelectAll() {
      if (this.selectAll) {
        this.selectedTasks = this.tasks.map(task => task.id);
      } else {
        this.selectedTasks = [];
      }
    },

    handleAddCategory(category) {
         console.log('Category',category);
      Inertia.post('add-category', category, {
        onSuccess: () => {
          this.showCatergoryModel = false;
        },
        onError: (errors) => {
          console.error('Error adding category:', errors);
          
        },
      });
    },
   
   
    handleAddTask(task) {

       Inertia.post('add-task', task, {
        onSuccess: () => {
           this.showTaskModal = false;
          
        },
        onError: (errors) => {
          console.error('Error adding task:', errors);
          
        },
      });
    },

    openEditModal(task) {
      this.EditTask = task;
      this.showEditModal = true;

    },
   
    handleTaskUpdate(edit) {
   Inertia.post('update-task', edit, {
        onSuccess: () => {
          this.showEditModal = false;
        },
        onError: (errors) => {
          console.error('Error adding task:', errors);
          
        },
      });
    },

  
   
  }
};
</script>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

</script>

