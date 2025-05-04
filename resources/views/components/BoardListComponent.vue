<template>
    <div>
        <div class="top-container">
            <h2>프로젝트 목록</h2>
            <button class="create-btn">+ 프로젝트 생성</button>
        </div>
  
        <div class="card-container">
            <div class="user-card">
                <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user icon" />
                <p class="title">프로젝트1</p>
                <p class="owner">담당자: 왕만두, 왕만두</p>
    
                <!-- <select v-model="project.status" @change="updateStatus(project)" class="status-select"> -->
                <select class="status-select">
                <option value="대기">대기</option>
                <option value="진행중">진행중</option>
                <option value="완료">완료</option>
                </select>
            </div>
    
            <div class="user-card">
                <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user icon" />
                <p class="title">프로젝트1</p>
                <p class="owner">왕만두, 왕만두</p>
    
                <!-- <select v-model="project.status" @change="updateStatus(project)" class="status-select"> -->
                <select class="status-select">
                <option value="대기">대기</option>
                <option value="진행중">진행중</option>
                <option value="완료">완료</option>
                </select>
            </div>

            <div class="user-card">
                <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user icon" />
                <p class="title">프로젝트1</p>
                <p class="owner">왕만두, 왕만두</p>
    
                <!-- <select v-model="project.status" @change="updateStatus(project)" class="status-select"> -->
                <select class="status-select">
                <option value="대기">대기</option>
                <option value="진행중">진행중</option>
                <option value="완료">완료</option>
                </select>
            </div>
        </div>
    </div>
  </template>
  
<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({ project: Object })

function updateStatus(project) {
  router.put(`/projects/${project.id}/status`, {
    status: project.status
  })
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
        margin-left: 600px;
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