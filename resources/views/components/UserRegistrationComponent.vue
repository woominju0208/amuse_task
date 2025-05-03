<template>
    <div class="form-box">
        <h2 class="form=title">회원가입</h2>
        <input type="text" name="account" placeholder="아이디" autocomplete="off">
        <input type="text" name="name" placeholder="이름" autocomplete="off">
        <input type="password" name="password" placeholder="비밀번호" autocomplete="off">
        <input type="password" name="password_chk" placeholder="비밀번호 확인" autocomplete="off">
        
        <hr>
        <button class="btn btn-submit btn-bg-black">회원가입</button>
        <button @click="$router.replace('/login')" class="btn btn-submit">취소</button>
    </div>
</template>

<script setup>

</script>

<style>
    
</style>