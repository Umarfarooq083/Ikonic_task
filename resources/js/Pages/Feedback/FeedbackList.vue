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
    feedbackData:Object,
  }
};

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <section class="intro mt-5" style="background-color: white;">
      <div class="container row">
        <div class="col-md-6 col-6 "></div>
        <div class="col-md-6 col-6 text-end mt-3">
          <Link :href="route('create.feedback')" class="btn btn-light-primary font-weight-bold ml-2"
           style="background-color: #007bff; color: white" >Create Feedback</Link>
        </div>
      </div>

      <!-- Table Section -->
      <div class="bg-image h-100 mt-3 " >
        <div class="mask d-flex align-items-center h-100">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12 mb-5">
                <div class="card" style="background-color: white;">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover mb-0" style="background-color: white;">
                        <thead>
                          <tr>
                            <th scope="col">Sr#</th>
                            <th scope="col">Title</th>
                            <th scope="col">description</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="feedbackList,index in this.feedbackData.data" :key="feedbackList.id">
                            <th scope="row"> {{ index + 1 }}</th>
                            <td> {{ feedbackList.title }}</td>
                            <td> {{ feedbackList.description }}</td>
                            <td> {{ feedbackList.user_data?.name }}</td>
                            <td>
                              <Link :href="route('feedback.comment',{'feedback_id':feedbackList.id})" style="background-color: #007bff;" class="btn btn-primary btn-sm">
                                Add Comment
                              </Link>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>
