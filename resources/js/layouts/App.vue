<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <router-link class="navbar-brand" :to="{name: 'Home'}">Home</router-link>
        <ul class="navbar-nav">
            <li class="nav-item">
                <router-link class="text-white" :to="{name: 'Login'}">Login</router-link>
            </li>
            <li class="nav-item">
                <router-link class="text-white ms-2" :to="{name: 'Register'}">Register</router-link>
            </li>
        </ul>
    </nav>
    <router-view></router-view>
</template>
