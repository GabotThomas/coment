<script setup>
import { useStore } from 'vuex';
import PopupButton from '../util/PopupButton.vue';

const store = useStore();
const user = store.getters.getUser;
const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
const date = (date) => {
    const dateBefore = new Date(date);
    const newDate = dateBefore.toLocaleDateString('fr-FR', options);
    return newDate.split(' ').slice(-2).join(' ');
}



</script>

<template>
    <div class="ui container profile">
        <div class="container-profile_header">
            <div class="profile-header_title">Mon profil</div>
        </div>
        <div class="profile-content">
            <div class="profile-header_content"></div>
            <div class="display">
                <div>
                    <div class="profile-content_name">
                        <h1 class="name">{{ user.name }} {{ user.lastname }}</h1>
                        <p class="username">{{ user.name }}{{ user.lastname }}</p>
                    </div>
                    <div class="profile-date">
                        <div class="date">
                            <img src="../../../img/icons/clock.svg" alt="" srcset="" class="date-clock">
                            Membre depuis {{ date(user.created_at) }}
                        </div>
                    </div>
                </div>
                <div class="profile-img_position">
                    <img src="../../../img/profile/profile-img.png" alt="" srcset="" class="profile-img">
                </div>
            </div>
            <div class="profile-header_content"></div>
        </div>
        <div class="profile-stat_content">
            <h1 class="stat-title">Statistiques</h1>
            <div class="grid">
                <div class="grid-stat_box">
                    <div class="stat-number">3</div>
                    Jours d'activités
                </div>
                <div class="grid-stat_box">
                    <div class="stat-number">34</div>
                    XP gagnés
                </div>
                <div class="grid-stat_box">
                    <div class="stat-number">10</div>
                    Diamants
                </div>
                <div class="grid-stat_box">
                    <div class="stat-number">2</div>
                    Niveaux
                </div>
            </div>
        </div>
        <div class="profile-success_content">
            <h1 class="success-title">Succès</h1>
            <div class="success-content">
                <div class="display border-top padding-top">
                    <div class="success-img_bg">
                        <img src="../../../img/icons/electric-flower.png" alt="" srcset="" class="success-img">
                    </div>
                    <div class="success-text">
                        <h1 class="success-text_title">Posture physique</h1>
                        <div class="progress-bar">
                            <div class="progress-bar__before percent-50"></div>
                        </div>
                        <p class="success-text_text">Les communicants non sexistes font sauter ces réflexes datés !</p>
                    </div>
                </div>
                <div class="display border-none padding-middle">
                    <div class="success-img_bg">
                        <img src="../../../img/icons/raimbow-flower.png" alt="" srcset="" class="success-img">
                    </div>
                    <div class="success-text">
                        <h1 class="success-text_title">Indicateur chromatique</h1>
                        <div class="progress-bar">
                            <div class="progress-bar__before percent-10"></div>
                        </div>
                        <p class="success-text_text">Votre créativité mérite mieux que ces raccourcis !</p>
                    </div>
                </div>
                <div class="display padding-bottom">
                    <div class="success-img_bg">
                        <img src="../../../img/icons/diamond-flower.png" alt="" srcset="" class="success-img">
                    </div>
                    <div class="success-text">
                        <h1 class="success-text_title">Rôle social</h1>
                        <div class="progress-bar">
                            <div class="progress-bar__before percent-75"></div>
                        </div>
                        <p class="success-text_text">Ce qui est en jeu : le systématisme !</p>
                    </div>
                </div>
                <div class="display border-bottom text-afficher">
                    <div class="success-text success-text_afficher">
                        <h1 class="success-text_title">Afficher tout</h1>
                        <img src="../../../img/icons/chevron-right.png" alt="" class="success-text_chevron">
                    </div>
                </div>
            </div>
        </div>
        <!-- <PopupButton></PopupButton> -->
    </div>
    <PopupButton />
</template>
