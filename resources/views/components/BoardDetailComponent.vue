<template>
    <div class="all">
      <div class="top-container">
        <h1 v-if="boardDetail" class="form-title">{{ boardDetail.title }}</h1>

        <div class="button-group">
          <router-link to="/boards/store">
            <button class="create-btn">수정</button>
          </router-link>
          <button class="delete-btn">삭제</button>
        </div>
      </div>
  
        <div v-if="boardDetail && boardDetail.user" class="main-container">
            <p>설명: {{ boardDetail.description }}</p>
            <p>상태: {{ boardDetail.status }}</p>
            <p>담당자: {{ boardDetail.user.name }}</p>
        </div>
      <div class="main-container">
          <div class="task">
            <h2>테스크 사항</h2>
            <router-link :to="`/boards/${project_id}/task`"><button class="create-btn">테스크 생성</button></router-link>
          </div>
          <div class="task-card" v-if="Array.isArray(boardDetail.task)">
            <div v-for="task in boardDetail.task" :key="task.task_id" class="user-row-scroll">
              <div class="user-card">
                <h3>{{ task.content }}</h3>
                <!-- <span>상태: {{ task.status }}</span> -->
                <select class="status-select" v-model="task.status" @change="updateStatus(task)">
                    <option value="대기">대기</option>
                    <option value="진행중">진행중</option>
                    <option value="완료">완료</option>
                </select>
                <hr>
                <span v-if="task.user">담당자: {{ task.user.name }}</span>
              </div>
            </div>
          </div>
          <div v-else class="task-card">
            <p>테스크 없음</p>
          </div>

      </div>
        
        <!-- <div v-else>
            <p>불러오는 중...</p>
        </div> -->

        <!-- 댓글 -->
        <!-- <h2 class="comment-no-data" v-if="!PostComment || PostComment.length === 0">새로운 댓글을 작성 해 주세요.</h2> -->
        <div class="comment-box">
          <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user icon" />
            <div class="comment-txt">
                <p>댓글작성했어요.</p>
          <div class="etc-btn">
            <!-- 삭제버튼 -->
            <!-- <button v-if="item.user.user_id === $store.state.auth.userInfo.user_id" @click="deleteComment(item.post_comment_id, key)" class="btn-comment-delete"><img style="width: 25px;" src="/developImg/btn-delete.png" alt=""></button> -->
          </div>
                <div class="comment-created">
                    <span class="comment-name">왕만두</span>
                    <span class="comment-date">2025.01.01</span>
                </div>
            </div>
        </div>
        <div class="comment-box">
          <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user icon" />
            <div class="comment-txt">
                <p>댓글작성했어요.댓글작성했어요.댓글작성했어요.댓글작성했어요.댓글작성했어요.댓글작성했어요.댓글작성했어요.댓글작성했어요.</p>
          <div class="etc-btn">
            <!-- 삭제버튼 -->
            <!-- <button v-if="item.user.user_id === $store.state.auth.userInfo.user_id" @click="deleteComment(item.post_comment_id, key)" class="btn-comment-delete"><img style="width: 25px;" src="/developImg/btn-delete.png" alt=""></button> -->
          </div>
                <div class="comment-created">
                    <span class="comment-name">왕만두</span>
                    <span class="comment-date">2025.01.01</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useStore } from 'vuex'

const route = useRoute();
const project = ref(null);
const store = useStore();

onMounted(() => {
  const id = route.params.id;
  store.dispatch('board/showBoard', id);
});

const boardDetail = computed(() => store.state.board.boardDetail);
console.log(store.state.board.boardDetail);

function updateStatus(project) {
    store.dispatch('board/updateStatus', project);
}

const project_id = computed(() => route.params.id);

</script>

<style scoped>
    .all {
      margin-left: 50px;
    }
    .top-container {
        display: flex;
        justify-content: space-between; 
        align-items: center;           
        width: 100%;
        padding: 20px 10px;
    }
    .button-group {
        display: flex;
        gap: 20px;
    }
    .form-title {
      font-size: 40px;
      font-weight: bold;
      white-space: nowrap;
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
        /* margin-left: 400px; */
        width: 100px;
    }
    .delete-btn {
        display: inline-block;
        margin-bottom: 16px;
        background: #c72020;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        /* margin-left: 500px; */
        width: 100px;
    }
    .create-btn:hover {
        background: #2367a0;
        color: white;
    }
    .delete-btn:hover {
      background: #9e1616;
      color: white;
    }
    .main-container {
      padding: 0 40px;
      margin-left: 50px;
    }
    .task{
      display: flex;
      justify-content: space-between; 
      align-items: center;           
      width: 100%;
      margin-right: 20px;
    }
    .task-card {
      display: flex;
      justify-content: flex-start;
      flex-wrap: wrap;
      max-width: 1000px;
      max-height: 500px;
      gap: 10px;
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
      padding: 10px;
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

    /* 댓글 창 디자인 */
    .comment-box {
      display: grid;
      grid-template-columns: 100px 1fr;
      width: 90%;
      padding: 30px;
      margin: 10px;
      border-bottom: 1px solid #939393;
      margin-left: 70px;
    }

    .etc-btn {
      display: flex;
      justify-content: flex-end;
    }

    .comment-img {
      border-radius: 50%;
      width: 70px;
      height: 70px
    }


    .comment-name {
      margin-right: 20px;
      font-weight: 500;
    }

    .comment-date {
      color: #939393;
      font-size: 15px;
    }

    .btn-more {
      width: 100px;
      margin: 20px 0;
    }

    .btn-comment-delete {
      text-align: center;
      cursor: pointer;
      border: none;
      background-color: transparent;
      /* margin: 0 5px; */
      width: 30px;
    }

    .btn-comment-report {
      border: 0;
      outline: 0;
      background-color: transparent;
      cursor: pointer;
      margin: 0 5px;
    }

    .comment-no-data {
      margin-top: 50px;
      font-size: 30px;
        color: #2986FF;
    }
</style>