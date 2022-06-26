<template>
    <div>

    <!-- Main content -->
    <section class="content container">
          <div class="row">
            <div class="col-md-6 offset-md-3">
    <div class="card mt-4 card-info" >
              <div class="card-header">
                <h3 class="card-title">Edit Post</h3>
                <div class="card-tools">
                    <router-link to="/posts" class="btn-sm btn-info">Posts</router-link>
                </div>
              </div>
              <!-- /.card-header -->
                 <div class=" card-info">

              <!-- /.card-header -->
              <!-- form start -->
               <form class="form-horizontal" enctype="multipart/form-data" @submit.prevent="updatePost">
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
                   <input type="hidden" name="" v-model="form.id">
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

                     <img width="50px" :src="fileLink(form.thumbnail)" alt="">
                  <div class="text-danger" v-if="form.errors.has('thumbnail')" v-html="form.errors.get('thumbnail')" />
                    </div>
                  </div>

                  <div class="form-group row">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                       <div class="form-check form-check-inline">
                    <input class="form-check-input" v-model="form.status" type="radio" id="active" value="published">
                    <label class="form-check-label" for="active">Published</label>
                    </div>
                       <div class="form-check form-check-inline">
                    <input class="form-check-input" v-model="form.status" type="radio" id="inactive" value="draft">
                    <label class="form-check-label" for="inactive">Draft</label>
                    </div>
                    <div class="text-danger" v-if="form.errors.has('status')" v-html="form.errors.get('status')" />
                    </div>


                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Update Post</button>

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
   name:"edit",
   data: function(){
    return{
     form: new Form({
        id:null,
        title:null,
        status:null,
        thumbnail:null,
        category_id:'',
        content:'',

       }),
        editor: ClassicEditor,
        editorData: '<p>Write content here</p>',
        editorConfig: {

        }
    }
   },
  mounted(){
     this.getPost(),
      this.$store.dispatch("getActiveCategories")
   },

     computed:{
    categories(){
        return this.$store.getters.categories;
    }
   },
   methods: {
    updatePost:function(){
         const forThis = this;
        this.form.post('/update-post')
        .then(function(data){

             Toast.fire({
            icon: 'success',
            title: 'Post updated successfully'
            });
              forThis.$router.push('/posts')
        });




    },
     getPost:function(){

           let this_ = this;
         axios.get("show-post/"+this.$route.params.id).then((response)=>{

             this_.form.fill(response.data.post);
         }).catch(()=>{

         })
   },
 loadThumbnail:function(e){
        let this__ = this;
        let file = e.target.files[0];
       const reader = new FileReader();
        reader.onload =(e)=> {
             this__.form.thumbnail = e.target.result;
        };
        reader.readAsDataURL(file);
            },
    fileLink:(name)=>{

         if(name.length < 256 ){
          return 'uploads/posts/'+name;
         }else{
           return this.form.thumbnail;
         }

             }

   },



}

</script>

<style>
a.btn-sm.btn-info {
    text-decoration: none;
}
</style>
