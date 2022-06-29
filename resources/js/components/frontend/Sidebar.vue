<template>


					<div class="sidebar-module-container">
						<div class="search-area outer-bottom-small">

                   </div>
                    <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                    <h3 class="section-title">Category</h3>
                    <div class="sidebar-widget-body m-t-10">
                        <div class="accordion">
                            <div class="accordion-group">
                                <div class="accordion-heading" v-for="item in categories">
                                    <router-link :to="`by-category/${item.slug}`" data-toggle="collapse" class="accordion-toggle collapsed">
                                       {{ item.name }}
                                    </router-link>
                                </div><!-- /.accordion-heading -->
                            </div><!-- /.accordion-group -->
                        </div><!-- /.accordion -->
                    </div><!-- /.sidebar-widget-body -->
                    </div>

              </div>
</template>

<script>
export default{
    name:"Sidebar",
     data:function(){
      return{}
   },
   mounted(){

      this.$store.dispatch("getCategories");
   },
   watch:{ },
   computed:{
    categories(){
        return this.$store.getters.categories;
    }
   },

}
</script>

<style>

</style>
