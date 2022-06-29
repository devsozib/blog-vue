<template >
     <div>
     <div class="col-md-9">

   <div class="blog-post   wow fadeInUp">
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
    name:"PostDetails",
    data:function(){
        return{
             post:{}
        }
    },
    components:{
        'sidebar': Sidebar
    },
    mounted(){
        this.postDetails()
    },
    methods:{
      postDetails:function(){
         axios.get("/post-details/" + this.$route.params.id).then((response) =>{
        //    console.log(response.data.post);

         this.post = response.data.post;
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

