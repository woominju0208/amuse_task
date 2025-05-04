<template>
    <div class="form-box">
        <h2 class="form-title">회원가입</h2>
        <input v-model="userInfo.name" type="text" name="name" placeholder="이름" autocomplete="off">
        <input v-model="userInfo.email" type="text" name="email" placeholder="아이디" autocomplete="off">
        <input v-model="userInfo.password" type="password" name="password" placeholder="비밀번호" autocomplete="off">
        <input v-model="userInfo.password_confirmation" type="password" name="password_confirmation" placeholder="비밀번호 확인" autocomplete="off">
        
        <hr>
        <button @click="$store.dispatch('user/register', userInfo)" class="btn btn-submit btn-bg-blue">회원가입</button>
        <button @click="$router.replace('/login')" class="btn btn-submit">취소</button>
    </div>
</template>

<script setup>
import { reactive } from 'vue';

const userInfo = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

</script>

<style>
    
</style>