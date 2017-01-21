<template>
    <div class="container">
        <div class="row">
            component ready
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$http.get('/check_relationship_status/'+this.profile_user_id)
                .then((response) => {
                    console.log(response);
                });
        },
        props: ['profile_user_id']
    }
</script>
