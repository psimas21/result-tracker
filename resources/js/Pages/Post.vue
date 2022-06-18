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
              <div class="sm:flex-auto"></div>
              <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button
                  type="button"
                  class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none sm:w-auto"
                  @click="resModal = true"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                  </svg>
                  <strong>Result</strong>
                </button>
              </div>
              <!-- POST RESULT MODAL -->
              <Modal
                title="Post Result"
                v-model="resModal"
                :closable="false"
                :mask-closable="false"
              >
                <Form ref="form" :model="form" :rules="ruleInline">
                  <FormItem prop="user_id">
                    <Input
                      type="number"
                      v-model="form.user_id"
                      placeholder="user id"
                    ></Input>
                  </FormItem>
                  <FormItem prop="party_id">
                  <Select v-model="form.party_id" placeholder="Select Party">
                      <Option v-for="(row, i) in partyData" :key="i" v-bind:value="row.id">{{row.party_name}}</Option>
                  </Select>
                  </FormItem>
                  <FormItem prop="lga_id">
                    <Input
                      type="number"
                      v-model="form.lga_id"
                      placeholder="lga id"
                    ></Input>
                  </FormItem>
                  <FormItem prop="ward_id">
                    <Input
                      type="number"
                      v-model="form.ward_id"
                      placeholder="ward id"
                    ></Input>
                  </FormItem>
                  <FormItem prop="pu_id">
                    <Input
                      type="number"
                      v-model="form.pu_id"
                      placeholder="pu id"
                    ></Input>
                  </FormItem>
                  <FormItem prop="vote_count">
                    <Input
                      type="number"
                      v-model="form.vote_count"
                      placeholder="vote count"
                    ></Input>
                  </FormItem>
                </Form>
                <template #footer>
                  <Button
                    type="default"
                    size="small"
                    @click="closeModal('form')"
                  >
                    Cancel
                  </Button>
                  <Button type="primary" size="small" @click="submit('form')">
                    Post
                  </Button>
                </template>
              </Modal>
              <!-- END MODAL -->
            </div>
            <div class="mt-8 flex flex-col">
              <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                  <div class="shadow-sm ring-1 ring-black ring-opacity-5">
                    <table
                      class="min-w-full border-separate"
                      style="border-spacing: 0;"
                      v-if="result != 0"
                    >
                      <thead class="bg-gray-50">
                        <tr>
                          <th
                            scope="col"
                            class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                          >
                            Name
                          </th>
                          <th
                            scope="col"
                            class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell"
                          >
                            Title
                          </th>
                          <th
                            scope="col"
                            class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell"
                          >
                            Email
                          </th>
                          <th
                            scope="col"
                            class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter"
                          >
                            Role
                          </th>
                          <th
                            scope="col"
                            class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8"
                          >
                            <span class="sr-only">Edit</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white">
                        <tr
                          v-for="(person, personIdx) in people"
                          :key="person.email"
                        >
                          <td
                            :class="[
                              personIdx !== people.length - 1
                                ? 'border-b border-gray-200'
                                : '',
                              'whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8',
                            ]"
                          >
                            {{ person.name }}
                          </td>
                          <td
                            :class="[
                              personIdx !== people.length - 1
                                ? 'border-b border-gray-200'
                                : '',
                              'whitespace-nowrap px-3 py-4 text-sm text-gray-500 hidden sm:table-cell',
                            ]"
                          >
                            {{ person.title }}
                          </td>
                          <td
                            :class="[
                              personIdx !== people.length - 1
                                ? 'border-b border-gray-200'
                                : '',
                              'whitespace-nowrap px-3 py-4 text-sm text-gray-500 hidden lg:table-cell',
                            ]"
                          >
                            {{ person.email }}
                          </td>
                          <td
                            :class="[
                              personIdx !== people.length - 1
                                ? 'border-b border-gray-200'
                                : '',
                              'whitespace-nowrap px-3 py-4 text-sm text-gray-500',
                            ]"
                          >
                            {{ person.role }}
                          </td>
                          <td
                            :class="[
                              personIdx !== people.length - 1
                                ? 'border-b border-gray-200'
                                : '',
                              'relative whitespace-nowrap py-4 pr-4 pl-3 text-right text-sm font-medium sm:pr-6 lg:pr-8',
                            ]"
                          >
                            <a
                              href="#"
                              class="text-indigo-600 hover:text-indigo-900"
                            >
                              Edit
                              <span class="sr-only">, {{ person.name }}</span>
                            </a>
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
import Layout from './Layout.vue'
export default {
  props:['partyData'],
  components: { Layout },
  data() {
    return {
      result: 1,
      resModal: false,
      people: [
        {
          name: 'Lindsay Walton',
          title: 'Front-end Developer',
          email: 'lindsay.walton@example.com',
          role: 'Member',
        },
        // More people...
      ],
      formInline: {
        user_id: '',
        party_id: '',
        lga_id: '',
        ward_id: '',
        pu_id: '',
        vote_count: '',
      },
      ruleInline: {
        user_id: [
          {
            required: true,
            message: 'Please fill in the user ID',
            trigger: 'blur',
          },
        ],
        party_id: [
          {
            required: true,
            message: 'Please fill in the party ID',
            trigger: 'blur',
          },
        ],
        lga_id: [
          {
            required: true,
            message: 'Please fill in the lga ID',
            trigger: 'blur',
          },
        ],
        ward_id: [
          {
            required: true,
            message: 'Please fill in the ward ID',
            trigger: 'blur',
          },
        ],
        pu_id: [
          {
            required: true,
            message: 'Please fill in the pu ID',
            trigger: 'blur',
          },
        ],
        vote_count: [
          {
            required: true,
            message: 'Please fill in the vote count',
            trigger: 'blur',
          },
        ],
      },
      itemId: null,
      form: this.$inertia.form({
        user_id: null,
        party_id: null,
        lga_id: null,
        ward_id: null,
        pu_id: null,
        vote_count: null,
      }),
    }
  },
  methods: {
    submit(name) {
      this.$refs[name].validate((valid) => {
        if (valid) {
          // this.$Message.success('Success!');
          this.form.post(route('post.store'), {
            // preverseScroll: true,
            onSuccess: () => {
              this.$refs[name].resetFields()
              this.resModal = false
              // this.form.reset();
            },
          })
        } else {
          this.$Message.error('Fail!')
        }
      })
    },
    closeModal(name) {
      this.$refs[name].resetFields()
      this.resModal = false
    },
    //Perform save and also update action
    submitData() {
      if (this.isUpdate) {
        this.form.put(route('employee.update', this.itemId), {
          preverseScroll: true,
          onSuccess: () => {
            this.isLoading = false
            this.dialog = false
            this.isUpdate = false
            this.itemId = null
            this.form.reset()
          },
        })
      } else {
        this.form.post(route('employee.store'), {
          preverseScroll: true,
          onSuccess: () => {
            this.isLoading = false
            this.dialog = false
            this.form.reset()
          },
        })
      }
    },
  },
}
</script>
