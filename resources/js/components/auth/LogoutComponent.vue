<template>


<h1>Logout</h1>


</template>

<script type="text/javascript">
export default {
    created() {
        User.logout();
        Toast.fire({
            icon: 'success',
            title: 'Logout successfully'
        });
        this.$router.push({ name: 'login'})
    },
    methods: {
        logout() {
            axios
                .post("api/auth/logout")
                .then((res) => {
                    User.logout();
                    Toast.fire({
                        icon: 'success',
                        title: 'Logout successfully'
                    });
                    this.$router.push({name: "login"});
                })
                .catch(error => console.log(error.response.data))
        },

    },
}
</script>

<style type="text/css"></style>
