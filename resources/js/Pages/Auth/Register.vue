<template>
    <body class="bg-dark">
  <div class="container">


  <div class="container m-1"></div>
    <div class="card card-register mx-auto mt-5">
      <div class="card-header"><h2>Create Account</h2></div>
      <div class="card-body">
        <form @submit.prevent="submit">
          <div class="form-group m-3">
            <div class="form-row row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <TextInput
                    id="name"
                    type="text"
                    class="form-control"
                    placeholder="Full Name"
                    v-model="form.name"
                    required
                    autofocus
                  />
                  <InputError :message="form.errors.name" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <TextInput
                    id="phone"
                    type="number"
                    class="form-control"
                    placeholder="Phone Number"
                    v-model="form.phone"
                    min="0"
                  />
                  <InputError :message="form.errors.phone" />
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group m-3">
              <TextInput
                id="email"
                type="email"
                class="form-control"
                placeholder="Email Address"
                v-model="form.email"
                required
              />
              <InputError :message="form.errors.email" />
            </div>
          </div>

          <div class="form-group m-3">
            <label for="state">Select State</label>
            <select class="form-control" id="state" v-model="form.state">
              <option v-for="state in states" :key="state" :value="state">{{ state }}</option>
            </select>
            <InputError :message="form.errors.state" />
          </div>

          <div class="form-group m-3">
            <label for="city">Select City</label>
            <select class="form-control" id="city" v-model="form.city">
              <option v-for="city in cities" :key="city" :value="city">{{ city }}</option>
            </select>
            <InputError :message="form.errors.city" />
          </div>

          <div class="form-group m-3">
            <div class="form-row row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <TextInput
                    id="password"
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    v-model="form.password"
                    required
                  />
                  <InputError :message="form.errors.password" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <TextInput
                    id="confirmPassword"
                    type="password"
                    class="form-control"
                    placeholder="Confirm Password"
                    v-model="form.password_confirmation"
                    required
                  />
                  <InputError :message="form.errors.password_confirmation" />
                </div>
              </div>
            </div>
          </div>

          <div class="form-group m-3">
            <div class="form-label-group border rounded">
              <label class="mx-2 mt-2 mb-0" for="avatar">Profile Image</label>

              <input
                type="file"
                id="avatar"
                class="form-control col-6"
                placeholder="Profile Image"
                @change="handleFileUpload" accept="image/*" 
                required
              />
            </div>
          </div>
          <div class="d-flex">
          <button type="submit" class="d-block col-11 btn btn-primary btn-block m-3">Create Account</button>
        </div>
        </form>

        <div class="text-center">
        <a class="d-block small mt-3" :href="route('login')">Already Have an Account? Log In</a>
        </div>
      </div>
    </div>
  </div>
    </body>
</template>

<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css'
import { ref } from 'vue';

const states = [
  'Dubai',
  'Sharjah',
  'Abu Dhabi',
  'Ajman',
  'Ras Al Khaimah',
  'Umm Al Quwain',
  'Fujairah',
];

const cities = [
  'Business Bay',
  'Karama',
  'Deira',
  'Qusais',
];

const form = useForm({
  name: '',
  phone: '',
  email: '',
  state: '',
  city: '',
  password: '',
  password_confirmation: '',
  avatar: null,
});

const handleFileUpload = (event) => {
  form.avatar = event.target.files[0];
};

const submit = () => {
  form.post('/register', {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<style scoped>
.container {
  max-width: 800px;
}
.bg-dark {
  background-color: #343a40 !important;
  color: white;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
.card {
  border-radius: 0.5rem;
  overflow: hidden;
}
a {
  text-decoration: none;
}
</style>
