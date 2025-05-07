<template>
    <div class="all">
      <div class="top-container">
        <h1 v-if="boardDetail" class="form-title">{{ boardDetail.title }}</h1>

        <div class="button-group">
          <router-link :to="`/boards/${project_id}/modify`">
            <button class="create-btn">수정</button>
          </router-link>
          <button class="delete-btn" @click="deleteBoard(project_id)">삭제</button>
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
                <select class="status-select" v-model="task.status" @change="updateStatusTask(boardDetail.project_id, task)">
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
        <div class="postdetail-comment-form-box">
          <h2>댓글목록</h2>
          <textarea v-model="commentInfo.comment" :placeholder="placeholder" name="comment" minlength="1" maxlength="200"></textarea>
          <button @click="$store.dispatch('board/storeComment', commentInfo)" class="btn-postdetail-comment create-btn" type="button">등록</button>
        </div>

        <div v-for="item in commentList" :key="item.comment_id" class="comment-box">
          <img class="user-icon" src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="user icon" />
            <div class="comment-txt">
                <p>{{ item.comment }}</p>
          <div class="etc-btn">
          </div>
                <div class="comment-created">
                    <span class="comment-name">{{ item.user.name }}</span>
                    <span class="comment-date">{{ item.created_at }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, reactive, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useStore } from 'vuex'

const route = useRoute();
const project = ref(null);
const store = useStore();
const router = useRouter();

onMounted(async () => {
  const id = route.params.id;
  await store.dispatch('board/showBoard', id);
  await store.dispatch('board/indexComment', { project_id: id });
  commentInfo.project_id = route.params.id;
});

const boardDetail = computed(() => store.state.board.boardDetail);
console.log(store.state.board.boardDetail);

function updateStatusTask(projectId, task) {
  store.dispatch('board/updateStatusTask', {
        project_id: projectId,
        task_id: task.task_id,
        status: task.status,
    });
};

const project_id = computed(() => route.params.id);

const deleteBoard = (id) => {
  store.dispatch('board/DeleteBoard', {project_id: id});
  router.replace('/boards');
};

const commentList = computed(() => store.state.board.commentList);
// console.log('댓글 리스트:', commentList.value);

const commentInfo = reactive({
    project_id: route.params.id,
    comment: '',
});

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

    .postdetail-comment-form-box {
      width: 100%;
      width: 1150px;
      padding: 20px;
      display: grid;
    }

    .postdetail-comment-form-box > textarea {
      border: solid 1px #000;
      border-radius: 5px;
      resize: none;
      width: 100%;
      height: 10em;
      font-size: 15px;
      padding: 10px;
      margin-bottom: 10px;
    }

    .btn-postdetail-comment {
      width: 100px;
      padding: 10px;
      font-size: 15px;
      border: none;
      cursor: pointer;
      justify-self: flex-end;
    }


    .comment-txt {
      width: 100%;
    }
</style>