<template>
 
<aside id="sidebar" class="sidebar bg-dark col-2 ">
<ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item ">
        <Link  class="nav-link bg-dark  text-light"  :href="route('dashboard')"   :class=" { 'collapsed': $page.url !== '/dashboard' }">
            <i class="fas fa-fw fa-home  text-light"></i>
            <span> Home  </span>
               </Link>
    </li>

    <li class="nav-item" >
        <Link  class="nav-link bg-dark  text-light" :href="route('logout')" method="post" as="button">
        <i class="fas fa-fw fa-user-circle  text-light"></i>
                            <span>Log Out</span>
                            </Link>
</li>

 



</ul>

</aside>


</template>



<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css'
const page = usePage()

</script>

<script>
export default {
  name: 'Sidebar'
};
</script>