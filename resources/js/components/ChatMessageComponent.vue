<template>
    <div class="message-area" ref="message">
        <Message
            v-for="message in messages"
            :key="message.id"
            :message="message">
        </Message>
    </div>
</template>

<script>
    import Message from './MessageComponent.vue'
    export default {
        components: {
            Message
        },
        data() {
            return {
                messages: []
            }
        },
        methods: {
            setMessage(message) {
                this.messages.push(message);

                if(message.selfMessage) {
                    this.$refs.message.scrollTop = 0;
                }
            }
        }
    }
</script>
<style>
    .message-area {
        height: 400px;
        max-height: 400px;
        overflow-y: scroll;
        padding: 15px;
        border-bottom: 1px solid #eee;
    }
</style>
