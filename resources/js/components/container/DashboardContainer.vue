<script setup>
import { onBeforeMount, watch, ref, computed } from "@vue/runtime-core";
import useFetch from "../../hooks/useFetch";
import Flag from '../../../img/level/flag.png';
import Diamond from '../../../img/level/diamond.png'
import DiamondWhite from '../../../img/level/diamond-white.png'
import DiamondDisabled from '../../../img/level/diamond-disabled.png'
import { makeClassName } from "../../functions/index";
import Link from "../util/Link.vue";

const [result, load, loading] = useFetch();
const levelStates = ref([]);
const maxDeg = 170;


onBeforeMount(() => {
    load({
        url: 'levelStates'
    })
})

watch(result, (currentValue, old) => {
    if (currentValue && currentValue.success) {
        levelStates.value = currentValue.levelStates;
    }
})


const calcProgress = (pourcentage) => {
    return { transform: `rotate(${pourcentage * maxDeg / 100}deg)` };
}


const imageLevel = (level) => {
    return level.image + (level.disabled ? "-disable" : "") + '.png'
}

</script>

<template>
    <div class="ui container level">
        <div v-for="levelState in levelStates" :key="levelState.id" class="level-state">
            <div class="level-title_container">
                <div class="img-flag">
                    <img :src="levelState.image + '.png'" alt="" class="img-smiley">
                    <img :src="Flag + '.png'" alt="">
                    <div class="level-flag">niveau {{ levelState.level }}</div>
                </div>
            </div>
            <div class="ui level">
                <div v-for="level in levelState.levels" :key="level.id"
                    :class="makeClassName('level', level.disabled && 'disabled')">
                    <Link :to="{ name: 'Quiz', params: { id: level.id } }" :disabled="level.disabled">
                    <div class="circle-wrap">
                        <div class="circle-state">
                            <div class="circle">
                                <div class="mask full" :style="calcProgress(level.pourcentage)
                                ">
                                    <div class="fill" :style="calcProgress(level.pourcentage)
                                    "></div>
                                </div>
                                <div class="mask half">
                                    <div class="fill" :style="calcProgress(level.pourcentage)
                                    "></div>
                                </div>
                            </div>
                        </div>
                        <div class="inside-circle deep">
                            <div class="deep-circle deep">
                                <img :src="imageLevel(level)" />
                            </div>
                        </div>
                        <div class="outline-img">
                            <img v-if="level.pourcentage == 100" :src="Diamond" />
                            <img v-else-if="level.disabled" :src="DiamondDisabled" />
                            <img v-else :src="DiamondWhite" />
                        </div>
                    </div>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
