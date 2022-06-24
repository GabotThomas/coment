
<script setup>
import confet from "../../../img/confettis/confettis.png";
import Wave from "../../../img/home/wave.png";
import { makeClassName } from "../../functions/index";

const props = defineProps({
    class: {
        type: String,
        default: '',
    }
})

</script>

<template>
    <div :class="makeClassName('back-confet', props.class)">
        <div class="background-color"></div>
        <div class="background-confet" :style="{ backgroundImage: `url(${confet})` }"></div>
        <img class="wave" :src="Wave" />
        <slot></slot>
    </div>
</template>