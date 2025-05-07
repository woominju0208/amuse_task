<template>
    <div>
        <div class="top-container">
            <h2 class="form-title">프로젝트 목록</h2>
            <router-link to="/boards/store"><button class="create-btn">+ 프로젝트 생성</button></router-link>
        </div>
  
        <div class="card-container">
            <div v-for="item in boardList" :key="item" class="user-card">
                <img class="user-icon" @click="goToDetail(item.project_id)" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user icon" />
                <p class="title" @click="goToDetail(item.project_id)">{{ item.title }}</p>
                <p class="owner" @click="goToDetail(item.project_id)" v-if="item.user">담당자: {{ item.user.name }}</p>
                <p class="owner" v-else>담당자: 없음</p>
    
                <select class="status-select" :class="{
                        waiting: item.status === '대기',
                        inprogress: item.status === '진행중',
                        done: item.status === '완료'
                      }" v-model="item.status" @change="updateStatus(item)">
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
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

const store = useStore();
// const props = defineProps({ project: Object })

// import { toRefs } from 'vue'
// const { boardList } = toRefs(store.state.board)

onMounted(() => {
    store.dispatch('board/indexBoard');
})
const boardList = computed(() => store.state.board.boardList);

function updateStatus(project) {
    // console.log('🔄 상태 변경 실행됨:', project.status);
    console.log('🔍 project:', project);
    store.dispatch('board/updateStatus', project);
}

const router = useRouter();
function goToDetail(id) {
    router.push(`/boards/${id}`);
}


</script>
  
<style scoped>
    .top-container {
        display: flex;
        justify-content: space-between; 
        align-items: center;           
        width: 100%;
        padding: 20px;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
        margin-left: 30px;
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

    /* BoardDetail */
    .board-detail-box {
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        width: 100vw;
        height: 100vh;
    }
    .board-detail-box > .item {
        /* width: 70vw; */
        width: 500px;
        height: 500px;
        max-width: 700px;
        background-color: #fff;
        padding: 10px;
    }
    .board-detail-box > .item > img {
        width: 100%;
    }
    .board-detail-box > .item > .etc-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-select.waiting {
      color: #f38b04;
    }
    .status-select.inprogress {
      color: #3bbb00;
    }
    .status-select.done {
      color: #2454a0;
    }
  </style>