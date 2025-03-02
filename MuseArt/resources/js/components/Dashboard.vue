<!-- resources/js/components/Dashboard.vue -->
<template>
    <div class="dashboard">
        <h1>Welcome, {{ user.name }}</h1>
        <h2>Hi mahi</h2>
        <!-- Add your dashboard content here -->
    </div>
    <div class="landing"></div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
        };
    },
    mounted() {
        this.fetchUserData();
    },
    methods: {
        fetchUserData() {
            axios
                .get("/api/user") // Fetch authenticated user data from the backend
                .then((response) => {
                    this.user = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching user data:", error);
                });
        },
    },
};
</script>

<style scoped>
.dashboard {
    padding: 20px;
    background-color: #f4f4f4;
    background-image: url("../../../public/images/floral.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-radius: 8px;
}
.landing {
    background-image: url("../../../public/images/floral.jpg");
}
</style>
