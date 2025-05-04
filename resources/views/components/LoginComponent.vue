<template>
    <div class="form-container">
        <div class="form-box">
            <p class="form-title">로그인</p>
            <input v-model="UserInfo.email" type="text" name="email" placeholder="아이디">
            <input v-model="UserInfo.password" type="password" name="password" placeholder="비밀번호">
            <button @click="$store.dispatch('user/login', UserInfo)" class="btn btn-submit btn-bg-blue">로그인</button>
        </div>

    </div>
</template>
<script setup>
import { reactive } from 'vue';

const UserInfo = reactive({
    email: '',
    password: '',
});
</script>
<style>

</style>