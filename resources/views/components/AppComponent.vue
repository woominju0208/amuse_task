<template>
    <div class="container">
      <!-- 사이드바 -->
      <aside class="sidebar">
        <h2 class="logo">📁 MiniPM</h2>
        <nav class="menu">
          <RouterLink to="/">홈</RouterLink>
          <RouterLink to="/boards">프로젝트</RouterLink>
          <!-- <RouterLink to="/tasks">작업 목록</RouterLink> -->
          <RouterLink to="/users">사용자</RouterLink>
        </nav>
      </aside>
  
      <!-- 메인 -->
      <div class="main">
        <header class="topbar">
          <div class="top-actions">
            <div v-if="!$store.state.user.authFlg">
              <RouterLink to="/login" class="btn btn-bg-blue">로그인</RouterLink>
              <RouterLink to="/register" class="btn btn-bg-gray">회원가입</RouterLink>
            </div>
            <div v-else>
              <button @click="$store.dispatch('user/logout')" class="btn btn-bg-red">로그아웃</button>
            </div>
          </div>
        </header>
  
        <main>
          <div class="container">
            <router-view />
          </div>
        </main>
      </div>
    </div>
  </template>
<script setup>
// import UserInfoComponent from './user/UserInfoComponent.vue';

</script>
<style>
    @import url('../../css/common.css');
</style>