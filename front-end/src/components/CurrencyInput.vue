<script setup>
  import { onMounted, defineModel, defineEmits, defineProps } from 'vue';
import { useCurrencyInput } from 'vue-currency-input';

  const model = defineModel()
  const emit = defineEmits(['input']);

  defineProps({
    label: String,
  });

  const options = {
    currency: 'BRL',
    currencyDisplay: 'symbol',
    hideCurrencySymbolOnFocus: false,
    hideGroupingSeparatorOnFocus: false,
    autoDecimalDigits: true,
    valueRange: {
      min: 0
    }
  };

  const { inputRef, setValue, formattedValue } = useCurrencyInput(options);

  onMounted(() => {
    if (!model.value) {
      model.value = 0;
    }

    setValue(model.value);
    console.log(model.value);
  })
</script>

<template>
  <input
    v-model="formattedValue"
    class="amount-input form-control"
    ref="inputRef"
    :label="label"
    type="text"
    @input="emit('input', model.value)" 
  />
</template>
