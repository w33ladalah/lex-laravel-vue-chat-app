<template>
    <div class="message col-md-6" :class="{'offset-md-6': message.type == 'client'}">
        <p class="body">{{ message.body }}</p>
    </div>
</template>

<script>
    export default {
        props: ['message'],
    }
</script>

<style>
    .user {
        font-weight: 800;
    }
    .body {
        margin-bottom: 0;
        white-space: pre-wrap;
    }
    .message {
        border: 1px solid #848181;
        background-color: #f0f0f0;
        padding: .5rem;
        border-radius: 5px;
        margin-bottom: .5rem;
    }
    .self {
        background-color: #f0f0f0;
        padding: 10px;
    }
</style>
