<template>
     <div class="form-box">
        <h3 class="form-title">새 프로젝트 생성</h3>
        <input v-model="boardInfo.title" type="text" name="title" maxlength="50">
        <textarea v-model="boardInfo.description" name="description" placeholder="내용을 입력 해 주세요." maxlength="200"></textarea>
        <button @click="$store.dispatch('board/storeBoard', boardInfo)" class="btn btn-bg-blue btn-submit">작성</button>
        <button @click="$router.push('/boards')" class="btn btn-submit">취소</button>
    </div>
</template>

<script setup>
import { reactive } from 'vue';

const boardInfo = reactive({
    title: '',
    description: '',
});
</script>

<style scoped>

</style>