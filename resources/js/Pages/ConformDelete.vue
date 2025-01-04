<template>
  <div class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Delete Task</h5>
      </div>
      <div class="modal-body">
        <h4>Are you sure you want to delete this task?</h4>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="closeModal">
          Cancel
        </button>
        <button type="button" class="btn btn-danger" @click="confirmDelete">
          Yes, Delete
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ConformDelete",
  props: {
    to_delete_id: {
      type: Number,
      required: true,
    },
  },
  methods: {
    closeModal() {
      this.$emit("close-confirm-modal");
    },
    confirmDelete() {
      this.$emit("delete-task", this.to_delete_id);
      this.closeModal();
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
  max-width: 500px;
}
</style>
