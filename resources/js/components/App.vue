<template>
    <div class="col-12">
        <div class="card">
            <div class="card-header">Chats</div>
            <div class="card-body">
                <ChatMessage ref="chatMessage"></ChatMessage>
                <ChatForm @message-added="addMessageCallback" @bot-response-received="displayBotResponse"></ChatForm>
            </div>
        </div>
    </div>
</template>

<script>
import ChatMessage from './ChatMessageComponent.vue'
import ChatForm from './ChatFormComponent.vue'
export default {
    name: 'MainApp',
    components: {
        ChatMessage,
        ChatForm
    },
    methods: {
        addMessageCallback(message) {
            this.$refs.chatMessage.setMessage(message)
        },
        displayBotResponse(message) {
            this.$refs.chatMessage.setMessage(message)
        }
    }
}
</script>
