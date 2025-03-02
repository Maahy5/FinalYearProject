<template>
    <div>
        <h1>Welcome to Laravel with Vue.js</h1>
        <p>This is a simple Vue.js component!</p>
        <nav>
            <a href="Home">
                <a href="Products">
                    <a href="Blogs">
                        <a href="About Us"> </a>
                    </a>
                </a>
            </a>
        </nav>
    </div>
</template>

<script>
export default {
    name: "App",
};
</script>

<style scoped>
h1 {
    color: #42b883;
}
.nav {
    background-image: url(../../../public/images/floral.jpg);
}
</style>
