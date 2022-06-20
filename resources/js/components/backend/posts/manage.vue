<template>
    <div>

    <!-- Main content -->
    <section class="content container">
          <div class="row">
            <div class="col-md-9 offset-md-1">
    <div class="card mt-4 card-info">
              <div class="card-header">
                <h3 class="card-title">All Posts</h3>
                <div class="card-tools">
                    <router-link to="/add-category" class="btn-sm btn-info">Add Posts</router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Author</th>
                      <th>Thumbnail</th>
                      <th>Status</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>


                    <tr v-for="(item, index) in posts">
                      <td>{{++index}}</td>
                      <td>{{item.title}} </td>
                      <td>{{item.category.name}} </td>
                      <td>{{item.user.name}} </td>
                      <td><img width="60px" :src="item.thumbnail" alt=""></td>
                      <td> <span class="badge bg-success" :class="statusColor(item.status)">{{postStatus(item.status)}}</span></td>
                      <td>
                           <router-link :to="`edit-post/${item.id}`" class="btn btn-info btn-sm" >Edit</router-link>
                           <button class="btn btn-danger btn-sm" @click="removePost(item.id)">Delete</button>
                      </td>

                    </tr>
                     <tr v-if="emptyData()">
                        <td colspan="4" class="text-danger text-center">Not Found</td>
                    </tr>
                  </tbody>

                </table>
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
export default{
   name:"manage",
   mounted(){
      this.$store.dispatch("getPosts")
   },
   computed:{
    posts(){
        return this.$store.getters.posts;
    }
   },

   methods:{
             postStatus(status){
                let data = {'draft': "Draft", 'published': "Published"}

                return data[status];
             },

             statusColor(status){
                      let color = {'draft': "bg-danger", 'published': "bg-success"}
                      return color[status];
             },
             removePost(id){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                        axios.get("remove-post/" + id).then((response)=>{
                         Toast.fire({
                            icon: 'success',
                            title: "Post Deleted Success"
                            });
                             this.$store.dispatch("getPosts")

                }).catch((error)=>{
                    console.log(error);
                })
                })

             },

             emptyData:function(){
                  return (this.posts.length < 1);
             }

   }
}

</script>

<style>
a.btn-sm.btn-info {
    text-decoration: none;
}
</style>
