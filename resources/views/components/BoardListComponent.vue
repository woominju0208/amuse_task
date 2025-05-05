<template>
    <div>
        <div class="top-container">
            <h2 class="form-title">프로젝트 목록</h2>
            <router-link to="/boards/store"><button class="create-btn">+ 프로젝트 생성</button></router-link>
        </div>
  
        <div class="card-container">
            <div v-for="item in boardList" :key="item" class="user-card">
                <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user icon" />
                <p class="title">{{ item.title }}</p>
                <p class="owner">담당자: {{ item.user.name }}</p>
    
                <select class="status-select" v-model="item.status" @change="updateStatus(item)">
                <option value="대기">대기</option>
                <option value="진행중">진행중</option>
                <option value="완료">완료</option>
                </select>
            </div>
            
    
        </div>
    </div>
  </template>
  
<script setup>
import { computed, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import { useStore } from 'vuex'

const store = useStore();
const props = defineProps({ project: Object })


onMounted(() => {
    store.dispatch('board/indexBoard');
})
const boardList = computed(() => store.state.board.boardList);
console.log(store.state.board.boardList);

function updateStatus(project) {
    // console.log('🔄 상태 변경 실행됨:', project.status);
    console.log('🔍 project:', project);
    store.dispatch('board/updateStatus', project);
}
</script>
  
<style scoped>
    .top-container {
        display: flex;
        justify-content: space-evenly; 
        align-items: center;           
        width: 100%;
        padding: 20px;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .create-btn {
        display: inline-block;
        margin-bottom: 16px;
        background: #3490dc;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        margin-left: 500px;
    }
    .create-btn:hover {
        background: #2367a0;
        color: white;
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
    width: 270px;
    padding: 30px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: white;
    text-align: center;
    cursor: pointer;
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

    .status-select {
    margin-top: 8px;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    }

    .title {
        font-weight: 500;
        font-size: 20px;
    }
  </style>