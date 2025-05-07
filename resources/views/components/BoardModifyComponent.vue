<template>
     <div class="form-box">
        <h3 class="form-title">프로젝트 수정</h3>
        <input v-if="boardDetail" v-model="boardInfo.title" type="text" name="title" placeholder="제목을 입력 해 주세요." maxlength="50">
        <textarea v-if="boardDetail" v-model="boardInfo.description" name="description" placeholder="내용을 입력 해 주세요." maxlength="200"></textarea>
        <button @click="$store.dispatch('board/updateBoard', boardInfo)" class="btn btn-bg-blue btn-submit">수정</button>
        <button @click="$router.back()" class="btn btn-submit">취소</button>
    </div>
</template>

<script setup>
import { computed, reactive, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex'

const store = useStore();
const route = useRoute();
const boardInfo = reactive({
    title: '',
    description: '',
    project_id: '',
});

const boardDetail = computed(() => store.state.board.boardDetail);

// boardDetail이 바뀌면 boardInfo에 반영
watch(boardDetail, (newVal) => {
  if (newVal) {
    boardInfo.title = newVal.title;
    boardInfo.description = newVal.description;
    boardInfo.project_id = newVal.project_id ?? route.params.id;
  }
}, { immediate: true });
</script>

<style scoped>

</style>