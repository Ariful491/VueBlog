import Vue from 'vue';

Vue.mixin({
    methods:{
        confirm: function (callback){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    callback();
                }
            })
        },
        loadThumbnail: function (e) {
            let file=e.target.files[0];
            var reader = new FileReader();
            reader.onload = (e) =>{
                this.form.thumbnail = e.target.result;

            }
            reader.readAsDataURL(file);

        },
        DataNull:function (){
            let calling =this;
            calling.form.title=null;
            calling.form.category_id='';
            calling.form.status=null;
            calling.form.description = '';
            calling.form.thumbnail=null;
        },
        subWithStr(content,lent){
            if(content.length>lent){
                return content.substring(0,lent)+'...'
            }
        }
    }
});
