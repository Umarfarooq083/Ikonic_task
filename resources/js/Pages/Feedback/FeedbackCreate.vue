<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


export default {
  components: {
    AuthenticatedLayout,
    Head,
    Link,
  },

  props:{
    categoryData:Object,
  },
  setup() {
    const form = useForm({
      title:'',
      description:'',
      category_id:''
    });
    return { form };
  },
  methods:{
    submit(){
      this.form.post(route('submit.feedback'))
    }
  }
};
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <section class="intro">
      <div class="d-flex flex-column justify-content-center align-items-center pt-3 pt-sm-0 bg-light">
        <div class="w-100 mt-3 px-3 py-4 overflow-hidden rounded-lg" style="max-width: 32rem; background-color: white; border: 1px solid #dee2e6;">
          <h1 class="text-2xl font-semibold mb-6 text-center">Create Feedback</h1>
          <form>
            <div>
              <label>Title</label>
              <input
                id="title"
                type="text"
                class="form-control"
                v-model="form.title"
                required
                style="border: 1px solid #ced4da; padding: 0.375rem 0.75rem;"
              />
              <span v-show="form.errors" style="color:red">{{form.errors.title}}</span>
            </div>

            <div class="mt-4">
              <label>Description</label>
              <input
                id="description"
                type="text"
                class="form-control"
                v-model="form.description"
                required
                style="border: 1px solid #ced4da; padding: 0.375rem 0.75rem;"
              />
              <span v-show="form.errors" style="color:red">{{form.errors.title}}</span>
            </div>

            <div class="mt-4">
              <label>Category</label>
              <select class="form-control" v-model="form.category_id" style="border: 1px solid #ced4da; padding: 0.375rem 0.75rem;">
                <option disabled selected>Select Category</option>
                <option v-for="categoryList,index in this.categoryData" :value="categoryList.id" :key="index">{{ categoryList.name }}</option>
              </select>
              <span v-show="form.errors" style="color:red">{{form.errors.category_id}}</span>
            </div>

            <div class="flex items-center justify-end mt-4">
              <button type="button" @click="submit"
                style="background-color: #007bff;" 
                class="btn btn-primary">
                Create
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>

