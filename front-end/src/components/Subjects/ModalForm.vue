<script setup>
import { ref, defineModel, defineEmits } from 'vue';
import { storeToRefs } from 'pinia'
import DialogBox from '../DialogBox.vue';
import { useSubjectsService } from '@/composables/Services/Subjects.Service';
import { useSubjectStore } from '@/stores/Subject.Store';

const emit = defineEmits(['refresh'])
const model = defineModel()
const { store, update } = useSubjectsService()
const { model: subjectModel } = storeToRefs(useSubjectStore())

const dialogModal = ref(null);

async function saveData() {
    const { error, message } = await store(subjectModel.value);
    if (error) {
        alert(message);
        return;
    }
    emit('refresh')
    model.value = false;
}

async function updateData() {
    const { error, message } = await update(subjectModel.value.cod, subjectModel.value);
    if (error) {
        alert(message);
        return;
    }
    emit('refresh')
    model.value = false;
}

</script>

<template>
    <DialogBox v-model="model" title="Novo livro" ref="dialogModal">
        <template #body>
            <form>
                <div class="form-group">
                    <label>Descriçõo</label>
                    <input v-model="subjectModel.descricao" class="form-control" maxlength="40"/>
                </div>
            </form>
        </template>

        <template #footer>
            <button v-if="subjectModel.cod" @click="updateData" class="btn btn-success">Atualizar</button>
            <button v-else @click="saveData" class="btn btn-success">Salvar</button>
        </template>
    </DialogBox>
</template>