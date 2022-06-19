<template>
    <div>

    <!-- Main content -->
    <section class="content container">
          <div class="row">
            <div class="col-md-9 offset-md-1">
    <div class="card mt-4 card-info">
              <div class="card-header">
                <h3 class="card-title">All Categories</h3>
                <div class="card-tools">
                    <router-link to="/add-category" class="btn-sm btn-info">Add Category</router-link>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>


                    <tr v-for="(item, index) in categories">
                      <td>{{++index}}</td>
                      <td>{{item.name}}</td>

                      <td> <span class="badge bg-success" :class="statusColor(item.status)">{{categoryStatus(item.status)}}</span></td>
                      <td>
                           <button class="btn btn-info btn-sm" >Edit</button>
                           <button class="btn btn-danger btn-sm" @click="removeCat(item.id)">Delete</button>
                      </td>
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
      this.$store.dispatch("getCategories")
   },
   computed:{
    categories(){
        return this.$store.getters.categories;
    }
   },

   methods:{
             categoryStatus(status){
                let data = {0: "InActive", 1: "Active"}

                return data[status];
             },

             statusColor(status){
                      let color = {0: "bg-danger", 1: "bg-success"}
                      return color[status];
             },
             removeCat(id){
                axios.get("remove-category/" + id).then((response)=>{
                         Toast.fire({
                            icon: 'success',
                            title: response.data
                            });
                }).catch((error)=>{
                    console.log(error);
                })
             }

   }
}

</script>

<style>
a.btn-sm.btn-info {
    text-decoration: none;
}
</style>
