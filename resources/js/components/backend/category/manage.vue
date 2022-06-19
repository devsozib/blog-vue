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


                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs</td>

                      <td><span class="badge bg-success">90%</span></td>
                      <td>

                      </td>
                    </tr>
                  </tbody>
                  {{ categories }}
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
        return this.$store.getters.test;
    }
   }
}

</script>

<style>
a.btn-sm.btn-info {
    text-decoration: none;
}
</style>
