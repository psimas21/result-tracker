<template>
    <layout></layout>
</template>
<script>
import Layout from "./Layout.vue";
export default {
    components: { Layout },
    data() {
        return {
         resModal: false,
            people: [
            { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
            // More people...
            ]
        }
    },

}
</script>
<script setup>
// const sidebarOpen = ref(false)
</script>