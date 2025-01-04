<template>
     <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard - Log In</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../../css/sb-admin.css" rel="stylesheet">
    <link href="../../../css/sb-admin.min.css" rel="stylesheet">
  </head>

  <body class="bg-dark">


  <div class="container m-1">
    <div class="card card-login mx-auto mt-4">
      <div class="card-header">
        <h2>Log In</h2>
      </div>
      <div class="card-body m-1">
         <form method="POST"  @submit.prevent="submit" class="row g-3 needs-validation" novalidate>
                    <div class="form-group">
                <div class="form-label-group">
             <TextInput
                    id="email"
                    type="email"
                    class="mt-1 m-1 mt-2 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    placeholder="Email address"
                />
                <InputError class="mt-2" :message="form.errors.email" />
         
          </div>
          </div>
          <div class="form-group">
             <TextInput
                    id="password"
                    type="password"
                    class="m1 m-1 mt-2 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="Password"
                />
                <InputError class="mt-2" :message="form.errors.password" />

                <InputError  :message="form.errors.is_active" />
          </div>
          <div class="form-group">
               <div class="form-check ms-0 mt-2 block" style="padding-left: 0.5em;">
                        <Checkbox class="m-1" name="remember" v-model:checked="form.remember" />
                        <label class="form-check-label m-1" for="rememberMe">Remember me</label>
                      </div>
          </div>
          <button type="submit" class="col-12 btn btn-primary btn-block mt-2">Login</button>
        </form>
        <div class="text-center">
            <a class="d-block small mt-2" :href="route('register')" >Register an Account</a>
        </div>
      </div>
    </div>
  </div>
</body>
  </html>
</template>


<script setup>
import { ref } from "vue";
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';


import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});
// const form = useForm({
//     email: 'mogahidgaffar@gmail.com',
//     password: '12345678',
//     remember: false,
// });

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<style scoped>
.container {
  max-width: 600px;
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
