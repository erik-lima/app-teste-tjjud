<script setup>
import { defineProps, defineModel } from "vue";

const model = defineModel();

defineProps({
  title: {
    type: String,
    default: "",
  },
});

</script>

<template>
  <div v-if="model">
    <div class="backdrop-screen"></div>
    <div class="my-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
            <button
              type="button"
              class="btn-close"
              @click="model=!model"
            ></button>
          </div>
          <div class="modal-body">
            <slot name="body" />
          </div>
          <div class="modal-footer">
            <slot name="footer"></slot>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<style scoped>
.my-modal {
  --bs-modal-zindex: 1055;
    --bs-modal-width: 500px;
    --bs-modal-padding: 1rem;
    --bs-modal-margin: 0.5rem;
    --bs-modal-color: var(--bs-body-color);
    --bs-modal-bg: var(--bs-body-bg);
    --bs-modal-border-color: var(--bs-border-color-translucent);
    --bs-modal-border-width: var(--bs-border-width);
    --bs-modal-border-radius: var(--bs-border-radius-lg);
    --bs-modal-box-shadow: var(--bs-box-shadow-sm);
    --bs-modal-inner-border-radius: calc(var(--bs-border-radius-lg) - (var(--bs-border-width)));
    --bs-modal-header-padding-x: 1rem;
    --bs-modal-header-padding-y: 1rem;
    --bs-modal-header-padding: 1rem 1rem;
    --bs-modal-header-border-color: var(--bs-border-color);
    --bs-modal-header-border-width: var(--bs-border-width);
    --bs-modal-title-line-height: 1.5;
    --bs-modal-footer-gap: 0.5rem;
    --bs-modal-footer-bg: ;
    --bs-modal-footer-border-color: var(--bs-border-color);
    --bs-modal-footer-border-width: var(--bs-border-width);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 5;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
    display: block;
}

.backdrop-screen {
  position: fixed;
  width: 100vw;
  height: 100vh;
  top: 0;
  left: 0;
  background: #000000AA;
  z-index: 3;
}
</style>