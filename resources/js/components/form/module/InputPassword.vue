<script setup>
import { computed, ref, watch } from "@vue/runtime-core";


const props = defineProps({
    value: undefined,
    handleChange: Function,
    placeholder: { type: String, required: false },
    type: String,
    name: String,
});

const passwordShow = ref(false);

const hidePassword = () => {
    passwordShow.value = true;
}

const showPassword = () => {
    passwordShow.value = false;
}

const type = computed(() => {
    return passwordShow.value == false ? "password" : "text";
})

const setValue = (e) => {
    props.handleChange(e, e.target);
};
</script>

<template>
    <div class="ui password">
        <input
            v-bind:type="type"
            v-bind:placeholder="props.placeholder"
            v-bind:name="props.name"
            @input="setValue"
            :value="props.value"
            class="ui input"
        />
        <span v-show="passwordShow" class="show-password" @click="showPassword"><img src="../../../../img/icons/eye_close.svg" alt=""></span>
        <span v-show="!passwordShow" class="show-password" @click="hidePassword"><img src="../../../../img/icons/eye-open.svg" alt=""></span>
    </div>
</template>
