<template>
  <div class="modal">
      <div class="modal-content">
        <form @submit.prevent="submitForm">
          <div class="modal-header">
            <h5 class="modal-title">Add Category</h5>
          
          </div>
          <div class="modal-body">
            <div class="form-group m-2">
              <label for="catname">Category Name</label>
              <input v-model="category.title" type="text" class="form-control" name="title" placeholder="Enter Name of Category" required>
            </div>
            <div class="form-group m-2">
              <label for="description">Description</label>
              <textarea v-model="category.description" class="form-control" name="description" rows="3" ></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeCategoryModal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div> 
</template>


 <script>
export default {
   name: 'AddCategoryModal',
  props: {
    isVisible: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      category: {
        title: '',
        description: ''
      }
    };
  },

  

  methods: {
    closeCategoryModal() {
      this.$emit('close');
    },
    submitForm() {
      // Handle form submission logic here
      this.$emit('add-category', { ...this.category });
      this.category.title = '';
      this.category.description = '';
      this.closeCategoryModal();
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
}
</style>
