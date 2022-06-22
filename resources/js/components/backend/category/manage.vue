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
                      <th><input type="checkbox" @click="selectAll" :disabled="emptyData()" v-model="selectedAll"></th>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>


                    <tr v-for="(item, index) in categories">
                        <td><input type="checkbox" :value="item.id" v-model="selected"></td>
                      <td>{{++index}}</td>
                      <td>{{item.name | subString(10)}} </td>

                      <td> <span class="badge bg-success" :class="statusColor(item.status)">{{categoryStatus(item.status)}}</span></td>
                      <td>
                           <router-link :to="`edit-category/${item.slug}`" class="btn btn-info btn-sm" >Edit</router-link>
                           <button class="btn btn-danger btn-sm" @click="removeCat(item.slug)">Delete</button>
                      </td>
                    </tr>
                    <tr>
                        <td v-if="!emptyData()">
                            <button @click="removeAll(selected)" :disabled="!isSelected" class="btn btn-info btn-sm">Remove</button>
                            <button @click="changeStatus(selected,1)" :disabled="!isSelected" class="btn btn-info btn-sm">Published</button>
                            <button @click="changeStatus(selected,0)" :disabled="!isSelected" class="btn btn-info btn-sm">Draft</button>
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

      this.$store.dispatch("getCategories");
   },
   watch:{
       selected:function(selected){
          this.isSelected = (selected.length > 0);
          this.selectedAll = (selected.length == this.categories.length);
       },
       idSelected:function(selected){
            this.selectedAll
       }
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
             removeCat(slug){

                 this.confirm(()=>{
                     axios.get("remove-category/" + slug).then((response)=>{
                        Toast.fire({
                           icon: 'success',
                           title: "Category Deleted Success"
                           });

                            this.$store.dispatch("getCategories")

                        }).catch((error)=>{
                            console.log(error);
                        })
                 })

             },

             emptyData:function(){
                  return (this.categories.length < 1);
             },

             selectAll:function(event){
                if(event.target.checked ==false){
                       this.selected = []
                }else{
                    this.categories.forEach((category)=>{
                        this.selected.push(category.id);
                    })
                }
             },

             removeAll:function(selected){
                 axios.post("categories/remove-items",{data:selected}).then((response)=>{
                            this.selected=[];
                            this.selectedAll=false;
                            this.isSelected=false;


                          Toast.fire({
                            icon: 'success',
                            title: response.data.total+ "Category Deleted Success"
                            });

                     this.$store.dispatch("getCategories")
                 }).catch((error)=>{
                      console.log(error);
                 })





             },
             changeStatus:function(selected, status){
                  axios.post("categories/change-status",{data:selected, status:status}).then((response)=>{

                     let activeMessage = status == "1"?"active":"inactive"
                            this.selected=[];
                            this.selectedAll=false;
                            this.isSelected=false;


                          Toast.fire({
                            icon: 'success',
                            title: response.data.total+ "Category has been "+ activeMessage
                            });

                          this.$store.dispatch("getCategories")
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
