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
    userRecords:Object,
    feedbackCommentsData:Array,
  },
  data() {
      return {
        finalUserArray:[],
        users: this.finalUserArray,
        showSuggestions: false,
      };
    },
    setup(props) {
        const form = useForm({
          feedback_id:props.feedbackData.id,
          comment:'',
        });
        return { form };
    },
    computed: {
        filterUserNameFormArray(){
          const names = this.userRecords.map(item => item.name);
          this.finalUserArray = names;
        },
        filteredUsers() {
          const match = this.form.comment.match(/@(\w*)$/);
          if (!match) return [];
          return this.finalUserArray.filter(u => u.toLowerCase().startsWith(match[1].toLowerCase()));
        },
    },
  methods: {
    checkForMention() {
      const hasMention = /@\w*$/.test(this.form.comment);
      this.showSuggestions = hasMention;
    },
    addMention(user) {
      const parts = this.form.comment.split(/@(\w*)$/);
      this.form.comment = `${parts[0]}${user} `;
      this.showSuggestions = false;
    },
    formattedDate(date) {
      const parsedDate = new Date(date);
      const year = parsedDate.getFullYear();
      const month = parsedDate.getMonth() + 1; 
      const day = parsedDate.getDate();
      return `${day}-${month}-${year}`;
    },
    submitComment()
    {
      this.form.post(route('submit.comment'));
      this.form.comment = '';
    }
  }
};

</script>
<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <input type="hidden" :value="filterUserNameFormArray" />
    <section class="intro mt-5" style="background-color: white;">
      <div class="container row">
        <div class="col-md-2 col-6 "></div>
        <div class="col-md-8 col-6 mt-3">
          <div class="card">
            <div class="card-header">
              Feedback 
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>{{ feedbackData.description }}</p>
                <footer class="blockquote-footer">Author: {{ feedbackData.user_data.name }} On <cite>{{ formattedDate(feedbackData.created_at) }}</cite></footer>
              </blockquote>
            </div>
          </div>

          <div class="mt-3">
            <label>Add Your Comments </label>
            <span v-show="form.errors" style="color:red">{{form.errors.comment}}</span>
            <textarea class="form-control" v-model="this.form.comment" @input="checkForMention"></textarea>
            <div v-if="showSuggestions" class="mt-2">
              <ul class="list-group">
                <li v-for="(user, index) in filteredUsers" :key="index" @click="addMention(user)" class="list-group-item list-group-item-action">
                  {{ user }}
                </li>
              </ul>
            </div>
          </div>
          <button type="submit" @click="submitComment" style="background-color: #007bff;" class="btn btn-primary btn-sm mt-3">Submit Comment</button>
          <div class="card mt-5" v-if="this.feedbackCommentsData.length > 0" >
            <div class="card-header">
              All Comments  
            </div>
            <div class="card-body" v-for="feedbackList,index in this.feedbackCommentsData">
              <blockquote class="blockquote mb-0">
                <footer class="blockquote-footer">Name: {{ feedbackList.user_data.name }} On: {{ formattedDate(feedbackList.created_at) }}</footer>
                <p>Contant: {{ feedbackList.comment }}</p>
                <hr>
              </blockquote>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-6 "></div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>
