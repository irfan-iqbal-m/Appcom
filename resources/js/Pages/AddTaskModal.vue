<template>
  <div class="modal">
      <div class="modal-content">
        <form @submit.prevent="submitForm">
          <div class="modal-header">
            <h5 class="modal-title">Add Task</h5>
       
          </div>
          <div class="modal-body">
            <div class="form-group m-2">
              <label for="title">Task Name</label>
              <input v-model="task.title" type="text" class="form-control" name="title" placeholder="Enter Name of Task" required>
            </div>
            <div class="form-group m-2">
              <label for="description">Description</label>
              <textarea v-model="task.description" class="form-control" name="description" rows="3" placeholder="Type some details about the task"></textarea>
              <small class="form-text text-muted">(Optional)</small>
            </div>
            <div class="form-group m-2">
              <label for="startdate">Start Date</label>
              <input v-model="task.start_date" type="date" class="form-control" name="startdate" required>
            </div>
            <div class="form-group m-2">
              <label for="enddate">End Date</label>
              <input v-model="task.end_date" type="date" class="form-control" name="enddate" required>
            </div>
            <div class="form-group m-2">
              <label for="category">Select Category</label>
              <select v-model="task.category_id" class="form-control" id="category">
                <option value="" disabled>Select a category</option>
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.title }}</option>
              </select>
            </div>
            <div class="form-group m-2">
              <div class="form-label-group border rounded">
              <label class="mx-2 mt-2 mb-0" for="image">Task Image</label>
              <input
                class="form-control col-6"
                @change="handleFileUpload" type="file" id="image" accept="image/*" 
                required
              />
            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeAddTaskModal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
</template>
 <script>
export default {
  name: 'AddTaskModal',
  props: {
    isVisible: {
      type: Boolean,
      required: true
    },
    categories: {
      type: Array,
      default: () => ["Visa", "Insurance", "Medical"],
    },
  },
  data() {
    return {
      task: {
        name: "",
        description: "",
        start_date: "",
        end_date: "",
        category_id: "",
        image: null,
      },
    };
  },
  methods: {
    closeAddTaskModal() {
      this.$emit("close");
    },
    handleFileUpload(event) {
      this.task.image = event.target.files[0];
    },
    submitForm() {
      const formData = new FormData();
      formData.append("title", this.task.title);
      formData.append("description", this.task.description);
      formData.append("start_date", this.task.start_date);
      formData.append("end_date", this.task.end_date);
      formData.append("category_id", this.task.category_id);
      formData.append("image", this.task.image);

      this.$emit("add-task", formData);

      // Reset form fields
      this.task = {
        title: "",
        description: "",
        start_date: "",
        end_date: "",
        category_id: "",
        image: null,
      };

      this.closeAddTaskModal();
    },
  },
};
</script>

<style scoped>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: 5px;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: white;
  padding: 20px;
  border-radius: 8px;
  width: 100%;
  max-width: 900px;
  max-height: 750px;
}
</style>
