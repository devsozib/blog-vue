<template>
     <div>
     <div class="col-md-9">

   <div class="blog-post wow fadeInUp" v-for="post in posts">
	<img class="img-responsive" :src="fileLink(post.thumbnail)" alt="">
	<h1>{{post.title}}</h1>
	<span class="author">{{post.user.name}}</span>
	<span class="date-time">{{post.created_at}}</span>
	<p v-html="post.content"></p>

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
    name:"byCategory",
    data:function(){
        return{
             posts:{}
        }
    },
    components:{
        'sidebar': Sidebar
    },
    mounted(){
        this.byCategoryPost()
    },
    methods:{
      byCategoryPost:function(){
         axios.get("/by-category-post/" + this.$route.params.slug).then((response) =>{
        //    console.log(response.data.posts);

         this.posts = response.data.posts;
         }).catch((error) =>{
          console.error(error)
         })
      },

  fileLink:(name)=>{
                 return 'uploads/posts/'+name;
             }
    }
}
</script>

<style>

</style>
