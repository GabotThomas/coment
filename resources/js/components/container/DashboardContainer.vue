<script setup>
import { onBeforeMount, watch, ref, computed } from "@vue/runtime-core";
import useFetch from "../../hooks/useFetch";
import Flag from '../../../img/level/flag.png';
import Diamond from '../../../img/level/diamond.png'
import DiamondWhite from '../../../img/level/diamond-white.png'

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
                <div v-for="level in levelState.levels" :key="level.id" class="level">
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
                                <img :src="level.image + '.png'" />
                            </div>
                        </div>
                        <div class="outline-img">
                            <img v-if="level.pourcentage == 100" :src="Diamond" />
                            <img v-else :src="DiamondWhite" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
