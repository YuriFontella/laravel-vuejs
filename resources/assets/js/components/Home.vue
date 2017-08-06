<template>
  <div class="container">
    <div class="row pull-right">
      <router-link to="/create">
        <a class="btn btn-primary">Create</a>
      </router-link>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Example Component</div>

          <div v-if='loading'>Carregando...</div>

          <div class="panel-body">
            <ul>
              <li v-for='notebook in notebooks'>
                <form @submit.prevent='update(notebook.id)'>
                <div v-show='!show(notebook.id)'>
                  <h4>{{notebook.name}} by {{notebook.user.name}}</h4>
                  <p>{{notebook.body}}</p>

                  <button type="button" @click='edit(notebook.id)'>editar</button>
                  <button type="button" @click='destroy(notebook.id)'>excluir</button>
                </div>

                <div v-show='show(notebook.id)'>
                  <input type="text" class="form-control" v-model='notebookData.name'>
                  <input type="text" class="form-control" v-model='notebookData.body'>

                  <button type="submit">Ok</button>
                  <button type="submit" @click.prevent='form = false'>Cancelar</button>
                </div>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notebooks: [],
      loading: false,
      form: '',

      notebookData: { name: '', body: '' }
    }
  },
  methods: {
    edit(id) {
      this.notebooks.forEach((notebook, i) => {
        if (notebook.id == id) {
          this.notebookData = notebook;
        }
      })

      return this.form = id;
    },
    show(id) {
      if (this.form == id) {
        return true;
      }

      return false;
    },
    update(id) {
      axios.put('/notebooks/' + id, this.notebookData)
           .then(response => { 
             console.log(response);
             this.form = false;
             this.notebookData = '';
             this.$router.push('/');
          })
           .catch(error => {
             console.log(error.response);
           })
    },
    destroy(id) {
      if(confirm('Tem certeza que deseja excluir?')) {
        axios.delete('/notebooks/' + id).then(response => {
          console.log(response);
          this.fetch();
        });
      }
    },

    fetch() {
      this.loading = true;
      axios.get('/notebooks').then((response) => { this.notebooks = response.data; this.loading = false; });
    }
  },
  mounted() {
    //var self = this;
    //axios.get('/notebooks').then(function(response) {
    //	return self.notebooks = response.data;
    //});

    this.fetch();
  }
}
</script>
