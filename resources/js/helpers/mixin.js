import Vue from 'vue';

Vue.mixin({
   methods: {
       confirm:function(callback){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                 if(result.value) callback();
            })
       },

       subStringWithLength:function(text, length, s){
        return text.substring(0, length) + s;
 }


   },
})
