
<template>
    <div class="form-inline">
        <div v-if="!passwordHidden">
            <label>
                <input type="text" class="password-field form-control d-inline ui input" v-model="passwordText" />
                <span class="display-eye fa fa-eye-slash" @click="hidePassword"><img src="../../../img/icons/eye_close.svg" alt=""></span>
            </label>
        </div>
        <div v-if="passwordHidden">
            <label>
                <input type="password" class="password-field form-control d-inline ui input" v-model="passwordText" />
                <span class="display-eye fa fa-eye" @click="showPassword">show</span>
            </label>
        </div>
    </div>
</template>
<style scoped>
    .display-eye {
        cursor:pointer;
    }
</style>
<script>
    export default {
        props: {
            passwordText: {
                default: "",
                type: String
            },
            fieldLabel: {
                default: "",
                type: String
            }
        },
        data () {
            return {
                passwordHidden: {
                    default: false,
                    type: Boolean
                }
            }
        },
        methods: {
            hidePassword() {
                this.passwordHidden = true;
            },
            showPassword() {
                this.passwordHidden = false;
            }
        }
    };
</script>
