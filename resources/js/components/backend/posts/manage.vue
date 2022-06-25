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
                    <router-link to="/add-post" class="btn-sm btn-info">Add Posts</router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                     <th><input type="checkbox" @click="selectAll" :disabled="emptyData()" v-model="selectedAll"></th>
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
                       <td><input type="checkbox" :value="item.id" v-model="selected"></td>
                      <td>{{++index}}</td>
                      <td>{{item.title}} </td>
                      <td>{{item.category.name}} </td>
                      <td>{{item.user.name}} </td>
                      <td><img width="60px" :src="fileLink(item.thumbnail)" alt=""></td>
                      <td> <span class="badge bg-success" :class="statusColor(item.status)">{{postStatus(item.status)}}</span></td>
                      <td>
                           <router-link :to="`edit-posts/${item.id}`" class="btn btn-info btn-sm" >Edit</router-link>
                           <button class="btn btn-danger btn-sm" @click="removePost(item.id)">Delete</button>
                      </td>

                    </tr>
                    <tr>
                        <td v-if="!emptyData()">
                            <button @click="removeAll(selected)" :disabled="!isSelected" class="btn btn-info btn-sm">Remove</button>
                            <button @click="changeStatus(selected,'published')" :disabled="!isSelected" class="btn btn-info btn-sm">Published</button>
                            <button @click="changeStatus(selected,'draft')" :disabled="!isSelected" class="btn btn-info btn-sm">Draft</button>
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
   data:function(){
      return{
        selected:[],
        selectedAll:false,
        isSelected:false
      }
   },
   mounted(){
      this.$store.dispatch("getPosts")
   },
  watch:{
       selected:function(selected){
          this.isSelected = (selected.length > 0);
          this.selectedAll = (selected.length == this.posts.length);
       },
       idSelected:function(selected){
            this.selectedAll
       }
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

                this.confirm(()=>{

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
             },
             selectAll:function(event){
                if(event.target.checked ==false){
                       this.selected = []
                }else{
                    this.posts.forEach((post)=>{
                        this.selected.push(post.id);
                    })
                }
             },
           removeAll:function(selected){
                 axios.post("posts/remove-items",{data:selected}).then((response)=>{
                            this.selected=[];
                            this.selectedAll=false;
                            this.isSelected=false;


                          Toast.fire({
                            icon: 'success',
                            title: response.data.total+ "Post Deleted Success"
                            });

                     this.$store.dispatch("getPosts")
                 }).catch((error)=>{
                      console.log(error);
                 })
             },

                   changeStatus:function(selected, status){
                  axios.post("posts/change-status",{data:selected, status:status}).then((response)=>{

                     let activeMessage = status == "published"?"published":"draft"
                            this.selected=[];
                            this.selectedAll=false;
                            this.isSelected=false;


                          Toast.fire({
                            icon: 'success',
                            title: response.data.total+ "Post has been "+ activeMessage
                            });

                          this.$store.dispatch("getPosts")
                 }).catch((error)=>{
                      console.log(error);
                 })

             },
              fileLink:(name)=>{
                 return 'uploads/posts/'+name;
             }

   }
}

</script>

<style>
a.btn-sm.btn-info {
    text-decoration: none;
}
</style>
