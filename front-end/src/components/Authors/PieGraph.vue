<script setup>
import { defineModel, onMounted, ref } from 'vue';

const model = defineModel();
const colors = ['#ba62ba', '#915b91', '#8da9c4', '#5a6f8e', '#563372', 'purple'];
const legends = ref([]);
const conicCSS = ref("conic-gradient(orange 50%, blue 50% 75%, red 75% 90%, green 90%)");

// Vlores precisam ser { "nome da fatia": 123 }
onMounted(() => {
    const totalValues = Object.values(model.value).reduce((total, current) => { return total + current },  0);
    let initialPos = 0;
    let index = 0;
    let pieSlices = [];

    for (let i in model.value) {
        const totalPercent = (model.value[i] / totalValues) * 100;
        
        if (index > colors.length) {
            index = 0;
        }

        legends.value.push({
            title: i,
            value: model.value[i],
            color: colors[index],
            percent: totalPercent.toFixed(1)
        });

        let color = colors[index];
        let endPosition = parseFloat(initialPos) + parseFloat(totalPercent)
        let startWith = initialPos === 0 ? "" : initialPos+"%";
        
        pieSlices.push(`${color} ${startWith} ${endPosition}%`);
        initialPos = endPosition;
        index++;
    }

    conicCSS.value = `conic-gradient(${pieSlices.join(',')})`;
})

</script>

<template>
    <div class="graph-container">
        <div class="pie"></div>
        <div class="legend">
            <div v-for="item in legends" :key="item.title" class="legend-item">
                <span class="dot-color" :style="`background:${item.color}`"></span>
                <span class="legend">{{ item.title }} ({{ item.value }}/{{ item.percent }}%)</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
.graph-container{
    display: flex;
    gap: 4rem;
    --conic: v-bind(conicCSS)
}

.pie {
  width: 200px;
  height: 200px;
  /* background-image: conic-gradient(orange 50%, blue 50% 75%, red 75% 90%, green 90%); */
  background-image: var(--conic);
  border-radius: 50%
}

.legend {
    display: flex;
    flex-direction: column;
    place-content: center;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 1rem
}

.dot-color {
    height: 1rem;
    width: 1rem;
    display: block;
    background: red;
    border-radius: 50%;
}
</style>