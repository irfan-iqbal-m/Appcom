
<template>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center bg-primary">

        <div class="d-flex align-items-center justify-content-between col-2">
            <Link class="logo d-flex align-items-center" :href="route('dashboard')">
            <img src="/dashboard-assets/img/app_logo.jpg" alt="">
            <span class="d-none d-lg-block text-light">Dashboard</span>
            </Link>
            <i class="bi bi-list toggle-sidebar-btn text-light" @click="toggleBodyClass"></i>
        </div>
        <!-- End Logo -->
   




    </header>

    <!-- Include the Sidebar here -->
    <Sidebar :translations="translations" :permissions=" page.props.Permissions" />

    <!-- Include the main content here -->

    <main id="main" class="main" >
        <div v-if="flashSuccess" class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
            role="alert">
             {{flashSuccess }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <main>
            <slot />
        </main>
    </main>



</template>


<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
defineProps({translations:Array })

const showingNavigationDropdown = ref(false);
</script>


<script>
import Sidebar from '@/Components/SideBar.vue';
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css'

const flashSuccess = computed(
    () => page.props.flash.success,
)

const page = usePage()

const user = computed(
    () => page.props.auth,
)

const notificationCount = computed(
  () => Math.min(page.props.auth.notificationCount, 9),
)



const changeLanguage = (event) => {
    const selectedLanguage = event.target.value;
    const currentUrl = window.location.origin; // Get the current app URL
    const newUrl = `${currentUrl}/lang/change?lang=${selectedLanguage}`; // Construct the new URL
    window.location.href = newUrl; // Redirect to the new URL
};



const isBodyActive = ref(false);

const toggleBodyClass = () => {
    // alert(1);
      isBodyActive.value = !isBodyActive.value;

      if (isBodyActive.value) {
        document.body.classList.add('toggle-sidebar');

      } else {
        document.body.classList.remove('toggle-sidebar');
      }
    };


    
export default {
    components: {
        Sidebar,
    },
  data() {
    return {
      parentMessage: 'Hello from Parent',
    };
  },
};
</script>
