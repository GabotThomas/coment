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
        <button v-on:click="handleOpen">
            <svg class="" width="59" height="57" viewBox="0 0 59 57" fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="29.07" cy="28.5" rx="29.07" ry="28.5" fill="#FECC00"/>
                <path d="M25.9587 14.8913L25.959 25.1849C22.5286 25.1854 19.096 25.1849 15.6648 25.1852C11.6952 25.1852 11.6963 31.3395 15.6648 31.3417C19.0952 31.34 22.5286 31.3403 25.9582 31.3417C25.9596 34.7728 25.9596 38.2039 25.9582 41.6351C25.9593 45.6025 32.1131 45.6025 32.1147 41.6351C32.1142 38.2036 32.1139 34.7713 32.1144 31.3409L42.4084 31.3414C46.3774 31.3409 46.3769 25.1854 42.4084 25.1849C38.9763 25.1849 35.5454 25.1849 32.113 25.1857C32.1133 21.7534 32.1128 18.3219 32.1133 14.8899C32.1139 10.9219 25.9587 10.9216 25.9596 14.8926" fill="white"/>
            </svg>
        </button>
    </div>
    <div :class="makeClassName('popup-container', open && 'open')" v-on:click="handleClose">
        <div class="popup-button">
            <div class="popup-button_display">
                <div class="button-ia">
                    <p class="ia-text">Test ta com</p>
                    <button v-on:click="handleMess" class="ia-img">
                        <img src="../../../img/icons/ia-button.svg" alt="">
                    </button>
                </div>
                <div class="button-message">
                    <p class="message-text">Besoin de parler</p>
                    <button v-on:click="handleMess">
                        <img src="../../../img/icons/help-button.svg" alt="">
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
