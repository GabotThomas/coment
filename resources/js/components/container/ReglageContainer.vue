<script setup>
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import PopupButton from '../util/PopupButton.vue';

const router = useRouter();
const store = useStore();

const handleLogOut = () => {
    localStorage.setItem("token", null);
    store.commit("setUser", null);
    store.commit("setToken", null);
    router.push({ name: "Login" });
};

</script>

<template>
    <div class="ui container reglage">
        <div class="container-reglage_header">
            <div class="reglage-header_title">Réglages</div>
        </div>
        <div class="reglage-content">
            <div class="reglage-header_content"></div>
        </div>
        <div class="reglage-option_content">
            <div class="reglage-option">
                <h1 class="reglage-option_title">Options générales</h1>
            </div>
            <div class="reglage-parametre">
                <ul>
                    <li>
                        <div>
                            <img src="../../../img/icons/Setting.png" alt="" class="reglage-icon">
                            <p>Général</p>
                        </div>
                        <img src="../../../img/icons/chevron-right.png" alt="" class="reglage-icon_chevron">
                    </li>
                    <li>
                        <div>
                            <img src="../../../img/icons/info.png" alt="" class="reglage-icon">
                            <p>Assistance</p>
                        </div>
                        <img src="../../../img/icons/chevron-right.png" alt="" class="reglage-icon_chevron">
                    </li>
                    <li>
                        <div>
                            <img src="../../../img/icons/list.png" alt="" class="reglage-icon">
                            <p>Informations</p>
                        </div>
                        <img src="../../../img/icons/chevron-right.png" alt="" class="reglage-icon_chevron">
                    </li>
                    <li>
                        <div>
                            <img src="../../../img/icons/share.png" alt="" class="reglage-icon">
                            <p>Partage tes performances</p>
                        </div>
                        <img src="../../../img/icons/chevron-right.png" alt="" class="reglage-icon_chevron">
                    </li>
                </ul>
            </div>
        </div>
        <div class="reglage-disconnecte">
            <div class="button">
                <button v-on:click="handleLogOut">Déconnexion</button>
            </div>
        </div>
    </div>
    <PopupButton />
</template>
