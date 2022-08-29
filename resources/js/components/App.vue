<template>
    <div class="col-12">
        <div class="card">
            <div class="card-header">Chats</div>
            <div class="card-body">
                <ChatMessage></ChatMessage>
                <ChatForm></ChatForm>
            </div>
        </div>
    </div>
</template>

<script>
import ChatMessage from './ChatMessageComponent.vue'
import ChatForm from './ChatFormComponent.vue'
export default {
    name: 'App',
    components: {
        ChatMessage,
        ChatForm
    }
}
</script>
