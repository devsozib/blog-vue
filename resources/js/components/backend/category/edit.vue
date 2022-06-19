<template>
    <div>

    <!-- Main content -->
    <section class="content container">
          <div class="row">
            <div class="col-md-6 offset-md-3">
    <div class="card mt-4 card-info" >
              <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
                <div class="card-tools">
                    <router-link to="/categories" class="btn-sm btn-info">Categories</router-link>
                </div>
              </div>
              <!-- /.card-header -->
                 <div class=" card-info">

              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" @submit.prevent="addCategory">
                {{ this.$route.params.id }}
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input name="name"  v-model="form.name" type="text" class="form-control" id="inputEmail3" placeholder="Type your category Name">
                  <div class="text-danger" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
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
                  <button type="submit"  class="btn btn-info">Update Category</button>
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

export default{
   name:"edit",
   data: function(){
    return{
       form: new Form({
        name:null,
        status:null
       })
    }
   },

   methods: {
    addCategory:function(){
         const forThis = this;
        this.form.post('/add-category')
        .then(function(data){
             Toast.fire({
            icon: 'success',
            title: 'Category added successfully'
            });
             forThis.form.name = null;
            forThis.form.status = null;
        });

        //  forThis.$router.push('categories')


    }
   }
}

</script>

<style>
a.btn-sm.btn-info {
    text-decoration: none;
}
</style>
