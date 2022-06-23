<script setup>
import { ref } from "vue";
import { makeClassName } from "../../functions/index";


const open = ref(false);

const handleOpen = (e) => {
    open.value = !open.value;
}

const handleClose = (e) => {
    open.value = false;
}

const handleMess = (e) => {
    e.preventDefault();
    e.stopPropagation();
}

</script>

<template>
    <div :class="makeClassName('popup-open', !open ? 'open' : 'close')">
        <button v-on:click="handleOpen">+</button>
    </div>
    <div :class="makeClassName('popup-container', open && 'open')" v-on:click="handleClose">
        <div class="popup-button">
            <div class="popup-button_display">
                <button v-on:click="handleMess">Messagerie</button>
                <button v-on:click="handleMess">IA</button>
            </div>
        </div>
    </div>
</template>
