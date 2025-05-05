<template>
    <div class="mypage-wrapper">
      <div class="mypage-container-title">
        <h1>사용자 목록</h1>
        <hr>
      </div>
      <div class="user-row-scroll">
        <div class="user-card" v-for="item in userList" :key="item">
          <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user icon" />
          <p class="user-name">{{ item.name }}</p>
          <p class="user-email">{{ item.email }}</p>
        </div>
      </div>
    </div>
  </template>

<script setup>
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

onMounted(() => {
    store.dispatch('board/indexUser');
})
const userList = computed(() => store.state.board.userList);
console.log(store.state.board.userList);
</script>

<style scoped>
.mypage-wrapper {
  display: block;
  width: 100%;
  padding: 20px;
}

.mypage-container-title {
  width: 100%;
  margin-bottom: 12px;
}

.mypage-container-title h1 {
  margin: 0;
  font-size: 24px;
}

.user-row-scroll {
  display: flex;
  flex-wrap: wrap;       
  overflow-x: auto;       
  gap: 16px;
  padding: 10px;
}

.user-card {
  flex: 0 0 auto;
  width: 200px;
  padding: 16px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: white;
  text-align: center;
}

.user-icon {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  margin-bottom: 8px;
}

.user-name {
  font-weight: 600;
  margin-bottom: 4px;
}

.user-email {
  font-size: 14px;
  color: #555;
}
</style>