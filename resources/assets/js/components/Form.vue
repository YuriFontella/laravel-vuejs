<template>
 
 <div class="container">
   
   <div class="row">
     
     <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
       
       <form @submit.prevent="add">
         <legend>Form Vue</legend>
       
         <div class="form-group">
           <label for="">Name</label>
           <input type="text" class="form-control" id="" placeholder="Name notebook" v-model='notebook.name'>
           <span class="text-danger">{{errors.name ? errors.name[0] : ''}}</span>
         </div>
       
         <div class="form-group">
           <label for="">Body</label>
           <input type="text" class="form-control" id="" placeholder="Body content" v-model='notebook.body'>
           <span class="text-danger">{{errors.body ? errors.body[0] : ''}}</span>
         </div>   
       
         <button type="submit" class="btn btn-primary">Submit</button>
       </form>
       
     </div>
     
   </div>
   
 </div>
 
</template>


<script>
export default {
  data() {
    return {
      notebook: {
        name: '',
        body: ''
      },

      errors: {}
    }
  },
  methods: {
    add() {
      axios.post('/notebooks', this.notebook)
           .then(response => {
             this.notebook = '';
             this.errors = '';
             this.$router.push('/');
           })
           .catch(error => {
             this.errors = error.response.data;
           });
    }
  },

  mounted() {

  }
}
</script>