import axios from "axios";
import router from "../../router";

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        boardDetail: null,
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setBoardDetail(state, board) {
            state.boardDetail = board;
        },


    },
    actions: {
        // 프로젝트 획득
        indexBoard(context, data) {
            const url = '/api/boards/';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }}
            
            axios.get(url, config)
            .then(response => {
                context.commit('setBoardList', response.data.boardList);
                console.log(response.data.boardList);
            })
            .catch(error => {
                console.log("API 호출 실패");
                console.log(error);
            });
        },
        // 프로젝트 상태변경
        updateStatus(context, project) {
            const url = `/api/boards/${project.project_id}/status`;
            const config = {
              headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                'Content-Type': 'application/json',
              }
            }
          
            axios.post(url, { status: project.status }, config)
              .then(response => {
                console.log("상태 변경 완료", response.data);
              })
              .catch(error => {
                console.error("상태 변경 실패", error);
              });
          },

        // 프로젝트 상세(task)
        showBoard(context, id) {
            const url = '/api/boards/' + id;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then(response => {
                context.commit('setBoardDetail', response.data.board);
            })
            .catch(error => {
                console.log(error);
            }); 
        },
        // 프로젝트 생성
        storeBoard(context, data) {
            const url = '/api/boards';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' +localStorage.getItem('accessToken'),
                }
            };

            // form data  생성
            const formData = new FormData();
            formData.append('content', data.content);
            formData.append('file', data.file);

            axios.post(url, formData, config)
            .then(response => {
                // 글작성 후 최상단 위치
                context.commit('setBoardListUnshift', response.data.board);
                // 다른 모듈 접근
                context.commit('user/setUserInfoBoardsCount', null);

                router.replace('/boards');
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                context.commit('setControllFlg', true);
            });
        }
    },
    getters: {
        getNextPage(state) {
            return state.page + 1;
        },
    }
}