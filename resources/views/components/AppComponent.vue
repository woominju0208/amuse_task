<template>
    <div class="container">
      <!-- 사이드바 -->
      <aside class="sidebar">
        <h2 class="logo">📁 MiniPM</h2>
        <ul class="menu">
          <li class="menu"><RouterLink to="/">홈</RouterLink></li>
          <li class="menu"><a @click.prevent="goTo('/boards')">프로젝트</a></li>
          <li class="menu"><a @click.prevent="goTo('/users')">사용자</a></li>
          <!-- <RouterLink to="/boards">프로젝트</RouterLink>
          <RouterLink to="/users">사용자</RouterLink> -->
        </ul>
      </aside>
  
      <!-- 메인 -->
      <div class="main">
        <header class="topbar">
          <div class="top-actions">
            <div v-if="!isAuthenticated">
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
import { computed } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
const store = useStore();
const router = useRouter();

// const isAuthenticated = computed(() => !!localStorage.getItem('accessToken'));
const isAuthenticated = computed(() => store.state.user.authFlg);

function goTo(path) {
  if (!isAuthenticated.value) {
    alert('로그인 후 이용 바랍니다.')
    router.push('/login')
  } else {
    router.push(path)
  }
}

</script>
<style>
    @import url('../../css/common.css');
</style>