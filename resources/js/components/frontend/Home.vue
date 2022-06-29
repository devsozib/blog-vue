<template>
<div>
     <div class="col-md-9">

   <div class="blog-post   wow fadeInUp" v-for="item in posts">
	<a href="blog-details.html"><img class="img-responsive" src="assets/images/blog-post/blog_big_03.jpg" alt=""></a>
	<h1><a href="blog-details.html">{{item.title}}</a></h1>
	<span class="author">Mark Doe</span>
	<span class="review">6 Comments</span>
	<span class="date-time">14/06/2014 11.00AM</span>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum...</p>
	<a href="#" class="btn btn-upper btn-primary read-more">read more</a>
   </div>
</div>

				<div class="col-md-3 sidebar">

                <sidebar/>

				</div>
</div>
</template>

<script>
import Sidebar from "./Sidebar.vue";
export default{
    name:"Home",
    components:{
        'sidebar':Sidebar
    },
     data:function(){
      return{}
   },
   mounted(){
      this.$store.dispatch("getPosts")
   },
  watch:{

   },
   computed:{
    posts(){
        return this.$store.getters.posts;
    }
   },


}
</script>

<style>

</style>
