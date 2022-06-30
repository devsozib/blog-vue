<template>
<div>
     <div class="col-md-9">

   <div class="blog-post   wow fadeInUp" v-for="item in posts">
	<router-link :to="`details/${item.id}`"><img class="img-responsive" :src="fileLink(item.thumbnail)" alt=""></router-link>
	<h1><router-link :to="`details/${item.id}`">{{item.title}}</router-link></h1>
	<span class="author">{{item.user.name}}</span>
	<span class="date-time">{{item.created_at}}</span>
	<p v-html="subStringWithLength(item.content,200,'...')">...</p>
	<router-link :to="`details/${item.id}`" class="btn btn-upper btn-primary read-more">read more</router-link>
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
   methods:{
     fileLink:(name)=>{
                 return 'uploads/posts/'+name;
             },


   },




}
</script>

<style>

</style>
