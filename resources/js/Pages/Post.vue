<template>
    <layout>
        <main class="flex-1">
            <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <h1 class="text-2xl font-semibold text-gray-900">Post Result</h1>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Replace with your content -->

                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none sm:w-auto" @click="resModal = true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <strong>Result</strong>
                        </button>
                    </div>
                    <!-- MODAL -->
                    <Modal title="Title" v-model="resModal" :closable="false">
                        <Form ref="formInline" :model="formInline" :rules="ruleInline">
                            <FormItem prop="user">
                                <Input type="text" v-model="formInline.user" placeholder="Username">
                                </Input>
                            </FormItem>
                            <FormItem prop="password">
                                <Input type="password" v-model="formInline.password" placeholder="Password">
                                </Input>
                            </FormItem>
                        </Form>
                        <template #footer>
                            <Button type="default" size="small" @click="resModal = false">Cancel</Button>
                            <Button type="primary" @click="handleSubmit('formInline')">Post</Button>
                        </template>
                    </Modal>
                    <!-- END MODAL -->
                    </div>
                    <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle">
                        <div class="shadow-sm ring-1 ring-black ring-opacity-5">
                            <table class="min-w-full border-separate" style="border-spacing: 0" v-if="result != 0">
                            <thead class="bg-gray-50">
                                <tr>
                                <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Name</th>
                                <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">Title</th>
                                <th scope="col" class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">Email</th>
                                <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">Role</th>
                                <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8">
                                    <span class="sr-only">Edit</span>
                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr v-for="(person, personIdx) in people" :key="person.email">
                                <td :class="[personIdx !== people.length - 1 ? 'border-b border-gray-200' : '', 'whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8']">{{ person.name }}</td>
                                <td :class="[personIdx !== people.length - 1 ? 'border-b border-gray-200' : '', 'whitespace-nowrap px-3 py-4 text-sm text-gray-500 hidden sm:table-cell']">{{ person.title }}</td>
                                <td :class="[personIdx !== people.length - 1 ? 'border-b border-gray-200' : '', 'whitespace-nowrap px-3 py-4 text-sm text-gray-500 hidden lg:table-cell']">{{ person.email }}</td>
                                <td :class="[personIdx !== people.length - 1 ? 'border-b border-gray-200' : '', 'whitespace-nowrap px-3 py-4 text-sm text-gray-500']">{{ person.role }}</td>
                                <td :class="[personIdx !== people.length - 1 ? 'border-b border-gray-200' : '', 'relative whitespace-nowrap py-4 pr-4 pl-3 text-right text-sm font-medium sm:pr-6 lg:pr-8']">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900"
                                    >Edit<span class="sr-only">, {{ person.name }}</span></a
                                    >
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /End replace -->
            </div>
            </div>
        </main>
    </layout>
</template>
<script>
import Layout from "./Layout.vue";
export default {
    components: { Layout },
    data() {
        return {
        result: 1,
         resModal: false,
            people: [
            { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
            // More people...
            ],
            formInline: {
                user: '',
                password: ''
            },
            ruleInline: {
                user: [
                    { required: true, message: 'Please fill in the user name', trigger: 'blur' }
                ],
                password: [
                    { required: true, message: 'Please fill in the password.', trigger: 'blur' },
                    { type: 'string', min: 6, message: 'The password length cannot be less than 6 bits', trigger: 'blur' }
                ]
            }
        }
    },
    methods: {
        handleSubmit(name) {
            this.$refs[name].validate((valid) => {
                if (valid) {
                    this.$Message.success('Success!');
                } else {
                    this.$Message.error('Fail!');
                }
            })
        }
    }

}
</script>