<template>
    <div>

    <!-- Main content -->
    <section class="content container">
          <div class="row">
            <div class="col-md-6 offset-md-3">
    <div class="card mt-4 card-info" >
              <div class="card-header">
                <h3 class="card-title">Create Post</h3>
                <div class="card-tools">
                    <router-link to="/posts" class="btn-sm btn-info">Posts</router-link>
                </div>
              </div>
              <!-- /.card-header -->
                 <div class=" card-info">

              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" enctype="multipart/form-data" @submit.prevent="addPost">
                <div class="card-body">
                       <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                       <select v-model="form.category_id" class="form-control">
                             <option value="">Choose One</option>
                             <option :value="item.id" v-for="item in categories">{{item.name}}</option>
                       </select>
                  <div class="text-danger" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <input name="title"  v-model="form.title" type="text" class="form-control" id="inputEmail3" placeholder="Type your category Name">
                  <div class="text-danger" v-if="form.errors.has('title')" v-html="form.errors.get('title')" />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                     <ckeditor :editor="editor" v-model="form.content" :config="editorConfig"></ckeditor>

                  <div class="text-danger" v-if="form.errors.has('content')" v-html="form.errors.get('content')" />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail</label>
                    <div class="col-sm-10">
                     <input type="file"  name="" id="thumbnail" @change="loadThumbnail($event)">
                     <img width="100px" :src="form.thumbnail" alt="">
                  <div class="text-danger" v-if="form.errors.has('thumbnail')" v-html="form.errors.get('thumbnail')" />
                    </div>
                  </div>

                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                       <div class="form-check form-check-inline">
                    <input class="form-check-input" v-model="form.status" type="radio" id="active" value="1">
                    <label class="form-check-label" for="active">Active</label>
                    </div>
                       <div class="form-check form-check-inline">
                    <input class="form-check-input" v-model="form.status" type="radio" id="inactive" value="0">
                    <label class="form-check-label" for="inactive">InActive</label>
                    </div>
                    <div class="text-danger" v-if="form.errors.has('status')" v-html="form.errors.get('status')" />
                    </div>


                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Add Post</button>
                  <button type="reset"  class="btn btn-info float-right">Reset</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
              <!-- /.card-body -->
            </div>
            </div>
             <div class="col-md-6">

            </div>
          </div>
    </section>
    <!-- /.content -->
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default{
   name:"crate",
   data: function(){

    return{
       isPostButton: false,
       form: new Form({

        title:null,
        status:null,
        category_id:[],
        content:'',
        thumbnail:null
       }),
        editor: ClassicEditor,
        editorData: '<p>Write content here</p>',
        editorConfig: {
            // The configuration of the editor.
        }

    }
   },

    mounted(){

      this.$store.dispatch("getActiveCategories");
   },
   watch:{
          postButton:function(category_id){
              if(category_id == !null){
                 this.isPostButton = true;
              }
          }

   },
     computed:{
    categories(){
        return this.$store.getters.categories;
    }
   },

   methods: {
    addPost:function(){
         const forThis = this;
        this.form.post('/add-post')
        .then(function(data){


             Toast.fire({
            icon: 'success',
            title: 'Post added successfully'
            });
             forThis.form.title = null;
            forThis.form.status = null;
            forThis.form.content = null;
            forThis.form.category_id = null;
        });
    },

    loadThumbnail:function(e){
        let file = e.target.files[0];
       const reader = new FileReader();
        reader.onload =(e)=> {
             this.form.thumbnail = e.target.result;
        };
        reader.readAsDataURL(file);
            }
   }
}

</script>

<style>
a.btn-sm.btn-info {
    text-decoration: none;
}
</style>
