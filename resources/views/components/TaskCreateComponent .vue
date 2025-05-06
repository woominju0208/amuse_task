<template>
     <div class="form-box">
        <h3 class="form-title">새 테스크 생성</h3>
        <textarea v-model="taskInfo.content" name="content" placeholder="내용을 입력 해 주세요." maxlength="200"></textarea>
        <button @click="$store.dispatch('board/storeTask', taskInfo)" class="btn btn-bg-blue btn-submit">작성</button>
        <button @click="$router.back()" class="btn btn-submit">취소</button>
    </div>
</template>

<script setup>
import { onMounted, reactive } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const taskInfo = reactive({
    project_id: route.params.id,
    content: '',
});

onMounted(() => {
  console.log('라우트 ID:', route.params.id);  // ← 여기서 undefined면 문제
  taskInfo.project_id = route.params.id;
});
</script>

<style scoped>

</style>