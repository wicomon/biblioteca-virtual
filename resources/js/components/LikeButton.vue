<template>
    <div>
    <span class="like-btn" @click="likeLibro" :class="{ 'like-active': this.like }"></span>
    <p>{{ cantidadLikes}} Likes.</p>
    </div>
</template>

<script>
export default {
    props: ['libroId', 'like' ,'likes'],
    data: function(){
        return{
            totalLikes: this.likes
        }
    },
    methods: {
        likeLibro(){
            axios.post('/libros/'+this.libroId)
                .then(respuesta => {
                    if (respuesta.data.attached.length>0) {
                        this.$data.totalLikes++;
                    }else{
                        this.$data.totalLikes--;
                    }
                })
                .catch(error => {
                    if (error.response.status === 401) {
                        
                        this.$swal({
                            title: 'Ooops....',
                            text: 'Debe ser un usuario registrado para poder dar likes!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ir al Login',
                            cancelButtonText: 'Permanecer Aqui'
                        }).then((result)=>{
                            if (result.value) {
                                window.location = '/login';
                            }
                            
                        })
                    }
                });
        }
    },
    computed: {
        cantidadLikes: function(){
            return this.totalLikes
        }
    }
}
</script>