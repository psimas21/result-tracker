<template>
    <Layout>
        <main class="flex-1">
            <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <h1 class="text-2xl font-semibold text-gray-900">Report</h1>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <h1>Welcome to Report Page!</h1>
                <router-link @click="goToPage('post')">Goto Post</router-link>
            </div>
            </div>
        </main>
    </Layout>
</template>
<script>
import Layout from "./Layout.vue";
export default {
    components: { Layout },
    data() {
        return {

        }
    },
    methods: {
        goToPage(page) {
            this.$inertia.visit(this.route(page));
        },
    },

}
</script>